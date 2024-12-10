<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    protected $fillable = [
        'vehicles_id',
        'name',
        'picture',
        'description',
        'price',
    ];

   

    public function rent()
    {
        return $this->hasMany(RentedVehicle::class);
    }

}
