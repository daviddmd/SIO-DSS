<?php

namespace App\Http\Livewire;

use App\Enums\InvoiceType;
use App\Models\Invoice;
use App\Models\InvoiceLine;
use App\Models\Product;
use Asantibanez\LivewireCharts\Models\ColumnChartModel;
use Asantibanez\LivewireCharts\Models\LineChartModel;
use Asantibanez\LivewireCharts\Models\PieChartModel;
use DateTime;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Livewire\Component;
use Livewire\WithPagination;

class CompanyGraphs extends Component
{
    use WithPagination;

    public $company;
    public $year = '';
    protected $listeners = [
        'customerClick' => 'handleCustomerClick',
    ];

    public function handleCustomerClick($bar)
    {
        $customer_id = $bar["extras"]["id"];
        return redirect()->route("customers.show", $customer_id);
    }

    public function mount($company)
    {
        $this->year = date("Y");
        $this->company = $company;
    }

    function random_color_part(): string
    {
        return str_pad(dechex(mt_rand(0, 255)), 2, '0', STR_PAD_LEFT);
    }

    function random_color(): string
    {
        return "#" . $this->random_color_part() . $this->random_color_part() . $this->random_color_part();
    }

    public function render(): Factory|View|Application
    {
        $invoices = Invoice::where("company_id", "=", $this->company->id)->whereYear("invoice_date", $this->year)->get();
        $invoicedAmount = $invoices->where("invoice_type", "!=", InvoiceType::NC)->sum("netTotal") -
            $invoices->where("invoice_type", "=", InvoiceType::NC)->sum("netTotal");
        $taxAmount = $invoices->where("invoice_type", "!=", InvoiceType::NC)->sum("taxPayable") -
            $invoices->where("invoice_type", "=", InvoiceType::NC)->sum("taxPayable");
        /*
         * 1: Selecionar Faturas de uma empresa com o ID definido cujo ano seja o atual
         * 2: Agrupar pelo ID do cliente
         * 3: Calcular soma da faturação dos clientes e número de faturas (vendas) do cliente
         * 4: Unir com a tabela dos clientes para obter o nome do cliente, selecionar e agrupar o mesmo
         * 5: Selecionar colunas a retornar
         */
        $customers = Invoice::where("invoices.company_id", "=", $this->company->id)->
        whereYear("invoice_date", $this->year)->
        groupBy("invoices.customer_id", "customers.name")->
        selectRaw("sum(netTotal) as salesTotal, count(invoices.id) as salesCount, customer_id, customers.name")->
        join("customers", "invoices.customer_id", "=", "customers.id");
        $topCustomersByNumberSales = (new PieChartModel())->setTitle(__("Top Customers By Number of Sales"))->withOnSliceClickEvent("customerClick")->setDataLabelsEnabled(true);
        $topCustomersByVolumeSales = (new ColumnChartModel())->withOnColumnClickEventName("customerClick")->setHorizontal(true)->setDataLabelsEnabled(true);
        /*
         * 1: Ordenar por ordem decrescente (operador salesTotal ou salesCount)
         * 2: Obter o Top n
         * 3: Obter todas as linhas associadas a esta query
         * 4: Após obter as linhas, limpar o operador de ORDER BY, visto que apenas queremos ordenar por uma coluna (ou operador)
         * 5: Repetir query
         */
        foreach ($customers->orderByDesc("salesCount")->take(3)->get() as $customer) {
            $topCustomersByNumberSales->addSlice($customer["name"], intval($customer["salesCount"]), $this->random_color(), ["id" => $customer["customer_id"]]);
        }
        $customers->getQuery()->orders = null;
        foreach ($customers->orderByDesc("salesTotal")->take(10)->get() as $customer) {
            $topCustomersByVolumeSales->addColumn($customer["name"], floatval($customer["salesTotal"]), $this->random_color(), ["id" => $customer["customer_id"]]);
        }
        $amountSoldFamilyPieChart = (new PieChartModel())->setTitle(__("Amount Billed By Family"))->setDataLabelsEnabled(true);
        $numberSalesFamilyPieChart = (new PieChartModel())->setTitle(__("Units Sold By Family"))->setDataLabelsEnabled(true);
        foreach (Product::select("family")->distinct()->pluck("family")->toArray() as $family) {
            $query = InvoiceLine::whereIn("invoice_id", Invoice::where("company_id", "=", $this->company->id)->
            where("invoice_type", "!=", InvoiceType::NC)->
            whereYear("invoice_date", $this->year)->pluck("id")->toArray())->
            whereIn("product_id", Product::where("family", "=", $family)->where("company_id", "=", $this->company->id)->pluck("id")->toArray());
            $amountSoldFamilyPieChart->addSlice($family, floatval($query->sum("amount")), $this->random_color());
            $numberSalesFamilyPieChart->addSlice($family, intval($query->sum("quantity")), $this->random_color());
        }
        /*
         * 1: Linhas de fatura que pertençam a faturas do ano selecionado e da empresa selecionada
         * 2: Agrupar pelo ID do produto
         * 3: Selecionar soma da quantidade de produtos e montantes faturados
         * 4: Unir com a tabela produtos e adicionar agrupamento para nome produto (e seleção)
         */
        $products = InvoiceLine::whereIn("invoice_id", Invoice::whereYear("invoice_date", $this->year)->where("company_id", $this->company->id)->pluck("id")->toArray())->
        groupBy("invoice_lines.product_id", "products.description")->
        selectRaw("sum(invoice_lines.amount) as productAmountSum, count(invoice_lines.quantity) as productQuantity, invoice_lines.product_id, products.description")->
        join("products", "invoice_lines.product_id", "=", "products.id");
        $topProductsByNumberSold = (new ColumnChartModel())->setHorizontal(true)->setDataLabelsEnabled(true);
        $topProductsByAmountBilled = (new ColumnChartModel())->setHorizontal(true)->setDataLabelsEnabled(true);
        foreach ($products->orderByDesc("productQuantity")->take(10)->get() as $product) {
            $topProductsByNumberSold->addColumn($product["description"], $product["productQuantity"], $this->random_color(), ["id" => $product["product_id"]]);
        }
        $products->getQuery()->orders = null;
        foreach ($products->orderByDesc("productAmountSum")->take(10)->get() as $product) {
            $topProductsByAmountBilled->addColumn($product["description"], $product["productAmountSum"], $this->random_color(), ["id" => $product["product_id"]]);
        }
        $sales = Invoice::where("company_id", "=", $this->company->id)->
        whereYear("invoice_date", "=", $this->year)->
        where("invoice_type", "!=", InvoiceType::NC)->
        selectRaw("MONTH(invoice_date) as invoiceMonth, sum(netTotal) as totalSales, count(id) as numberSales")->
        groupBy("invoiceMonth")->get();
        $salesNumberLineChart = (new LineChartModel())->setTitle(__("Number of Sales Monthly Evolution"))->setDataLabelsEnabled(true);
        $salesAmountLineChart = (new LineChartModel())->setTitle(__("Sales Amount Monthly Evolution"))->setDataLabelsEnabled(true);
        foreach ($sales as $monthSales) {
            $monthName = DateTime::createFromFormat('!m', $monthSales["invoiceMonth"])->format("F");
            $salesNumberLineChart->addPoint($monthName, intval($monthSales["numberSales"]));
            $salesAmountLineChart->addPoint($monthName, floatval($monthSales["totalSales"]));
        }
        //Obtém todos os anos de faturas presentes no sistema
        $years = Invoice::where("company_id", "=", $this->company->id)->
        selectRaw("YEAR(invoice_date) as invoiceYear")->
        groupBy("invoiceYear")->pluck("invoiceYear")->toArray();
        $cities = Invoice::where("company_id", "=", $this->company->id)->
        whereYear("invoice_date", $this->year)->
        where("invoice_type", "!=", InvoiceType::NC)->
        selectRaw("count(id) as cityCount, sum(netTotal) as citySum, shipping_city")->
        groupBy("shipping_city");
        $citiesPieChart = (new PieChartModel())->setTitle(__("Top Shipping Cities"))->setDataLabelsEnabled(true);
        $citiesBarChart = (new ColumnChartModel())->setTitle(__("Amount Billed by Shipping City"))->setDataLabelsEnabled(true);
        foreach ($cities->orderByDesc("cityCount")->take(10)->get() as $city) {
            $citiesPieChart->addSlice($city["shipping_city"], $city["cityCount"], $this->random_color());
        }
        $cities->getQuery()->orders = null;
        foreach ($cities->orderByDesc("citySum")->take(10)->get() as $city) {
            $citiesBarChart->addColumn($city["shipping_city"], $city["citySum"], $this->random_color());
        }
        return view('livewire.company-graphs', [
            "invoicedAmount" => $invoicedAmount,
            "numberSalesFamilyPieChart" => $numberSalesFamilyPieChart,
            "amountSoldFamilyPieChart" => $amountSoldFamilyPieChart,
            "taxAmount" => $taxAmount,
            "topCustomersByNumberSales" => $topCustomersByNumberSales,
            "topCustomersByVolumeSales" => $topCustomersByVolumeSales,
            "topProductsByNumberSold" => $topProductsByNumberSold,
            "topProductsByAmountBilled" => $topProductsByAmountBilled,
            "salesNumberLineChart" => $salesNumberLineChart,
            "salesAmountLineChart" => $salesAmountLineChart,
            "years" => $years,
            "citiesPieChart" => $citiesPieChart,
            "citiesBarChart" => $citiesBarChart
        ]);
    }
}
