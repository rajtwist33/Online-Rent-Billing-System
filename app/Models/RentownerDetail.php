<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RentownerDetail extends Model
{
    use HasFactory;
    protected $fillable = [
        'address',
        'phone',
        'user_id',
        'slug',
    ];
}
