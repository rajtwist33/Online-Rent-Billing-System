<?php

namespace App\Models\Renter;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Renter\Room;
use App\Models\Renter\Tenant;

class Electricitybillpayment extends Model
{
    use HasFactory;
    protected $table = 'electricitybillpayment';
    protected $fillable = [
        'user_id',
        'room_id',
        'tenant_id',
        'opening_unit',
        'closing_unit',
        'total_unit',
        'amount_tobe_paid',
        'paid_amount',
        'dues_amount',
        'advance_amount',
        'slug',
    ];

    public function tenant(){
        return $this->hasMany(Tenant::class,'id','tenant_id');
    }
    public function room(){
        return $this->hasOne(Room::class,'id','room_id');
    }

}
