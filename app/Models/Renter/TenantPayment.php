<?php

namespace App\Models\Renter;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TenantPayment extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'user_id',
        'tenant_id',
        'paid_amount',
        'paid_date',
        'dues',
        'advance',
        'slug',
    ];
}
