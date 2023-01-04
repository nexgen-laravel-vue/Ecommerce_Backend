<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerAdd extends Model
{
    use HasFactory;
    protected $table='customer_adds';
    protected $fillable = [
        'name',
        'phoneno',
        'FlatNumber',
        'HouseNumber',
        'Street',
        'City',
        'State',
        'PinOrZipCode',
        'Country',
        'userId',
        'is_ShippingAddress',
        'is_billingAddress'
    ];
}
