<?php

namespace App\Models\Renter;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Electricity_Bill extends Model
{
   protected $table = 'electricity_bills';
    use HasFactory;
    protected $fillable = [
        'user_id',
        'room_id',
        'opening_unit',
        'slug',
    ];

    public function room(){
        return $this->hasOne(Room::class,'id','room_id');
    }
}
