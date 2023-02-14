<?php

namespace App\Models\Renter;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TenantAdvancePayment extends Model
{
    use HasFactory;
    protected $fillable = [
       
        'user_id',
        'tenant_id',
        'paid_date',
        'paid_amount',
        'advance',
        'slug',
    ];
}
