<?php

use App\Enums\InvoiceType;
use App\Enums\ProductType;

return [
    ProductType::P->name => "Products",
    ProductType::S->name => "Services",
    ProductType::O->name => "Others",
    ProductType::E->name => "Special Taxes",
    ProductType::I->name => "Taxes, Duties & Parafiscal Charges",
    InvoiceType::FT->name => "Invoice",
    InvoiceType::FS->name => "Simplified Invoice",
    InvoiceType::FR->name => "Invoice-Receipt",
    InvoiceType::ND->name => "Debit Note",
    InvoiceType::NC->name => "Credit Note"

];
