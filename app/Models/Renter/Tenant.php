<?php

namespace App\Models\Renter;

use App\Models\Renter\Room;
use App\Models\Renter\TenantImage;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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
        'description',
        'slug',
    ];

    public function tenantimage(){
        return $this->belongsTo(TenantImage::class,'id','tenant_id');
    }
    public function tenanthasroom(){
        return $this->hasOne(Room::class,'id','room_id');
    }
}
