<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\RentedVehicle;
use App\Models\User;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // Total number of farmers
        $totalCustomers = User::where('role', 'customer')->count();

        // Total pending borrowed equipment
        $totalPending = RentedVehicle::where('status', 'pending')->count();

        // Total sales (sum of equipment price for approved borrowings)
        $totalSales = RentedVehicle::where('status', 'approved')
            ->join('vehicles', 'rented_vehicles.vehicles_id', '=', 'vehicles.id')
            ->sum('vehicles.price');

        $totalReturn = RentedVehicle::where('returned', '1')
            ->join('vehicles', 'rented_vehicles.vehicles_id', '=', 'vehicles.id')
            ->sum('rented_vehicles.returned');

        // Sales per equipment
        $salesPerVehicle = RentedVehicle::where('status', 'approved')
            ->join('vehicles', 'rented_vehicles.vehicles_id', '=', 'vehicles.id')
            ->select(DB::raw('vehicles.name as vehicle_name, SUM(vehicles.price) as total_sales'))
            ->groupBy('vehicles.name')
            ->get();

        // Pass data to the view
        return view('admin.dashboard', compact('totalCustomers', 'totalPending', 'totalSales', 'totalReturn', 'salesPerVehicle'));
    }
}