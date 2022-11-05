<?php

use App\Enums\InvoiceType;
use App\Enums\ProductType;

return [
    ProductType::P->name => "Produtos",
    ProductType::S->name => "Serviços",
    ProductType::O->name => "Outros",
    ProductType::E->name => "Impostos Especiais de Consumo",
    ProductType::I->name => "Impostos, Taxas e Encargos Parafiscais",
    InvoiceType::FT->name => "Fatura",
    InvoiceType::FS->name => "Fatura Simplificada",
    InvoiceType::FR->name => "Fatura-Recibo",
    InvoiceType::ND->name => "Nota de Débito",
    InvoiceType::NC->name => "Nota de Crédito"

];
