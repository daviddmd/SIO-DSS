<?php
namespace App\Enums;

enum InvoiceType: string
{
    case FT = "FT";
    case FS = "FS";
    case FR = "FR";
    case ND = "ND";
    case NC = "NC";
}
