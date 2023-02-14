<?php

namespace App\Models\Renter;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tenant extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'address',
        'phone',
        'parent_name',
        'parent_number',
        'fee',
        'room_id',
        'total_resident',
        'occupation',
        'user_id',
        'slug',
    ];
}
