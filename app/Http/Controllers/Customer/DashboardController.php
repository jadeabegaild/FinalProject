<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\RentedVehicle;
use App\Models\Vehicle;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $customerId = Auth::id(); // Get the currently logged-in customer's ID

        // Retrieve the counts of borrowed equipment by status
        $totalPending = RentedVehicle::where('user_id', $customerId)->where('status', 'pending')->count();
        $totalApproved = RentedVehicle::where('user_id', $customerId)->where('status', 'approved')->count();
        $totalRejected = RentedVehicle::where('user_id', $customerId)->where('status', 'rejected')->count();
        $totalReturned = RentedVehicle::where('user_id', $customerId)->where('returned', '1')->count();

        // Retrieve all equipment with prices
        $vehicleWithPrices = Vehicle::whereNotNull('price')->get();

        // Retrieve approved rentals for the current user (with vehicle and customer details)
        $approvedRentals = RentedVehicle::where('user_id', $customerId)
            ->where('rented_date')
            ->join('vehicles', 'rented_vehicles.vehicles_id', '=', 'vehicles.id')
            ->select('rented_vehicles.id', 'rented_vehicles.rented_date', 'vehicles.name as vehicle_name')
            ->get();
            

        // Pass the data to the view
        return view('customer.dashboard', [
            'totalPending' => $totalPending,
            'totalApproved' => $totalApproved,
            'totalRejected' => $totalRejected,
            'totalReturned' => $totalReturned,
            'vehicleWithPrices' => $vehicleWithPrices,
            'approvedRentals' => $approvedRentals,  // Pass approved rentals to the view
        ]);
    }
}
