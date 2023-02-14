<?php

namespace App\Models\Renter;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TenantImage extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'user_id',
        'tenant_id',
        'image_path',
        'slug',
    ];
}
