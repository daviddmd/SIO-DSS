<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Customer;
use App\Models\Invoice;
use App\Models\InvoiceLine;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Rebelo\Date\DateFormatException;
use Rebelo\SaftPt\AuditFile\AuditFile;
use Rebelo\SaftPt\AuditFile\AuditFileException;

class SaftUpload extends Controller
{
    /**
     * @param Request $request
     * @return Application|Factory|View
     */
    public function index(Request $request)
    {
        return view("saft-upload.index");
    }

    public function store(Request $request)
    {
        if ($request->hasFile("saft")) {
            $file = $request->file("saft");
            try {
                $auditFile = AuditFile::loadFile($file->path());
                $header = $auditFile->getHeader();
                $company = Company::where("tax_registration_number", "=", $header->getTaxRegistrationNumber())->first();
                if ($company == null) {
                    $companyAddress = $header->getCompanyAddress();
                    $company = Company::create([
                        "name" => $header->getCompanyName(),
                        "tax_registration_number" => $header->getTaxRegistrationNumber(),
                        "phone" => preg_replace("/[^+A-Za-z\d ]/", '', $header->getTelephone()),
                        "fax" => preg_replace("/[^+A-Za-z\d ]/", '', $header->getFax()),
                        "email" => $header->getEmail(),
                        "website" => $header->getWebsite(),
                        "address_detail" => $companyAddress->getAddressDetail(),
                        "address_postal_code" => $companyAddress->getPostalCode(),
                        "address_country" => $companyAddress->getCountry()->get(),
                        "address_city" => $companyAddress->getCity()
                    ]);
                }

                $companyProducts = Product::where("company_id", "=", $company->id)->pluck("code")->toArray();
                $companyCustomers = Customer::where("company_id", "=", $company->id)->pluck("tax_id")->toArray();
                $companyInvoices = Invoice::where("company_id", "=", $company->id)->pluck("invoice_number")->toArray();
                $masterFiles = $auditFile->getMasterFiles();
                $products = $masterFiles->getProduct();
                foreach ($products as $product) {
                    if (!in_array($product->getProductCode(), $companyProducts) && $product->getProductType() != "O") {
                        Product::create([
                            "description" => $product->getProductDescription(),
                            "code" => $product->getProductCode(),
                            "family" => $product->getProductGroup(),
                            "type" => $product->getProductType()->get(),
                            "number_code" => $product->getProductNumberCode(),
                            "company_id" => $company->id
                        ]);
                    }
                }
                $customers = $masterFiles->getCustomer();
                foreach ($customers as $customer) {
                    if (!in_array($customer->getCustomerTaxID(), $companyCustomers) && $customer->getCustomerTaxID() != "999999990") {
                        Customer::create([
                            "name" => $customer->getCompanyName(),
                            "tax_id" => $customer->getCustomerTaxID(),
                            "account_id" => $customer->getAccountID(),
                            "phone" => preg_replace("/[^+A-Za-z\d ]/", '', $customer->getTelephone()),
                            "email" => $customer->getEmail(),
                            "company_id" => $company->id,
                            "primavera_id" => $customer->getCustomerID()
                        ]);
                    }
                }
                $sourceDocuments = $auditFile->getSourceDocuments();
                $salesInvoices = $sourceDocuments->getSalesInvoices(false)->getInvoice();
                //$orders = $sourceDocuments->getWorkingDocuments(false)->getOrder();
                foreach ($salesInvoices as $salesInvoice) {
                    $invoiceLines = $salesInvoice->getLine();
                    if (!in_array($salesInvoice->getInvoiceNo(), $companyInvoices)) {
                        $shippingAddress = $salesInvoice->getShipTo()->getAddress();
                        $documentTotals = $salesInvoice->getDocumentTotals();
                        $invoice = Invoice::create([
                            "company_id" => $company->id,
                            "customer_id" => Customer::where("primavera_id", "=", $salesInvoice->getCustomerID())->first()->id,
                            "invoice_number" => $salesInvoice->getInvoiceNo(),
                            "invoice_date" => Carbon::createFromFormat("Y-m-d", $salesInvoice->getInvoiceDate()->format("Y-m-d")),
                            "shipping_city" => $shippingAddress->getCity(),
                            "shipping_country" => $shippingAddress->getCountry()->get(),
                            "invoice_type" => $salesInvoice->getInvoiceType()->get(),
                            "taxPayable" => $documentTotals->getTaxPayable(),
                            "netTotal" => $documentTotals->getNetTotal(),
                            "grossTotal" => $documentTotals->getGrossTotal()
                        ]);
                        foreach ($invoiceLines as $invoiceLine) {
                            InvoiceLine::create([
                                "invoice_id" => $invoice->id,
                                "product_id" => Product::where("code", "=", $invoiceLine->getProductCode())->first()->id,
                                "quantity" => $invoiceLine->getQuantity(),
                                "unitPrice" => $invoiceLine->getUnitPrice(),
                                "taxPercentage" => $invoiceLine->getTax()->getTaxPercentage(),
                                "amount" => floatval($invoiceLine->getDebitAmount()) == 0 ? floatval($invoiceLine->getCreditAmount()) : floatval($invoiceLine->getDebitAmount())
                            ]);
                        }
                    }
                }

            } catch (AuditFileException|DateFormatException $e) {
            }
        }
        return redirect()->route("saft-upload.index");
    }

}
