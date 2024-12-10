<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RentedVehicle extends Model
{
    use HasFactory;

    protected $fillable = [
        'vehicles_id',
        'user_id',
        'rented_date',
        'status',
        'returned', // Add this line
    ];

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function vehicles()
    {
        return $this->belongsTo(Vehicle::class, 'vehicles_id');
    }
}
