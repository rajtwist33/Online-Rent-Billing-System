<?php

namespace App\Models;

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
        'advance',
        'slug',
    ];
}
