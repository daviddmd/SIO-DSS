<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Company extends Model
{
    use HasFactory;

    protected $fillable = [
        "name",
        "tax_registration_number",
        "phone",
        "fax",
        "email",
        "website",
        "address_detail",
        "address_city",
        "address_postal_code",
        "address_country"
    ];

    public function customers(): HasMany
    {
        return $this->hasMany(Customer::class);
    }

    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }
    public function invoices(): HasMany
    {
        return $this->hasMany(Invoice::class);
    }

}
