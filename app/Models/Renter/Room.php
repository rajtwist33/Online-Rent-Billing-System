<?php

namespace App\Models\Renter;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'user_id',
        'status',
        'description',
        'slug',
    ];
}
