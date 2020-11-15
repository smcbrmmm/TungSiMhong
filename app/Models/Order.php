<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function payment_informations(){
        return $this->belongsTo(PaymentInformation::class);
    }

    public function shipment_information(){
        return $this->hasOne(ShipmentInfo::class);
    }

    public function orderDetails(){
        return $this->hasMany(OrderDetail::class);
    }
}
