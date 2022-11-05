<?php

namespace App\Models;

use App\Enums\ProductType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        "code",
        "family",
        "type",
        "description",
        "number_code",
        "company_id"
    ];
    protected $casts = [
        "type" => ProductType::class
    ];

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    public function productLines()
    {
        return InvoiceLine::where("product_id", "=", $this->id)->whereIn("invoice_id", $this->company->invoices->pluck("id")->toArray());
    }

    public function numberSales(): int
    {
        return $this->productLines()->count();
    }

    public function sumSales()
    {
        return $this->productLines()->sum("amount");
    }
}
