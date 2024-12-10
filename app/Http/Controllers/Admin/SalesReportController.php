<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\RentedVehicle;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use Carbon\Carbon;

class SalesReportController extends Controller
{
    public function index(Request $request)
    {
        // Filters
        $startDate = $request->input('start_date') ? Carbon::parse($request->input('start_date')) : Carbon::now()->startOfMonth();
        $endDate = $request->input('end_date') ? Carbon::parse($request->input('end_date')) : Carbon::now()->endOfMonth();
        $vehicleId = $request->input('vehicles_id');

        // Query for total and monthly sales
        $query = RentedVehicle::selectRaw('SUM(vehicles.price) as total_sales')
            ->join('vehicles', 'rented_vehicles.vehicles_id', '=', 'vehicles.id')
            ->where('rented_vehicles.status', 'approved')
            ->whereBetween('rented_vehicles.updated_at', [$startDate, $endDate]);

        if ($vehicleId) {
            $query->where('rented_vehicles.vehicles_id', $vehicleId);
        }

        $totalSales = $query->value('total_sales') ?: 0;

        // Monthly Sales (grouped by month)
        $monthlySales = RentedVehicle::selectRaw('YEAR(rented_vehicles.updated_at) as year, MONTH(rented_vehicles.updated_at) as month, SUM(vehicles.price) as monthly_sales')
            ->join('vehicles', 'rented_vehicles.vehicles_id', '=', 'vehicles.id')
            ->where('rented_vehicles.status', 'approved')
            ->groupBy('year', 'month')
            ->orderBy('year', 'desc')
            ->orderBy('month', 'desc')
            ->get();

        // Table Data: Sales per Equipment
        $vehicleSales = RentedVehicle::selectRaw('vehicles.name as vehicle_name, vehicles.price as vehicle_price, COUNT(rented_vehicles.id) as total_rented, SUM(vehicles.price) as total_sales')
            ->join('vehicles', 'rented_vehicles.vehicles_id', '=', 'vehicles.id')
            ->where('rented_vehicles.status', 'approved')
            ->groupBy('vehicles.id', 'vehicles.name', 'vehicles.price')
            ->orderBy('total_sales', 'desc')
            ->get();

        $vehicles = Vehicle::all();

        return view('admin.sales_report.index', compact('totalSales', 'monthlySales', 'vehicleSales', 'vehicles', 'startDate', 'endDate', 'vehicleId'));
    }
}