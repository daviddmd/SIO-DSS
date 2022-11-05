<?php

namespace App\Models;

use App\Enums\InvoiceType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = [
        "name",
        "tax_id",
        "account_id",
        "phone",
        "email",
        "company_id",
        "primavera_id"
    ];

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    public function invoices(): HasMany
    {
        return $this->hasMany(Invoice::class);
    }

    public function invoicesNetSum()
    {
        $invoices = $this->invoices()->get();
        return $invoices->where("invoice_type", "!=", InvoiceType::NC)->sum("netTotal") -
            $invoices->where("invoice_type", "=", InvoiceType::NC)->sum("netTotal");
    }
}
