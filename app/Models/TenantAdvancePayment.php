<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TenantAdvancePayment extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'user_id',
        'tenant_id',
        'paid_amount',
        'dues',
        'advance',
        'slug',
    ];
}
