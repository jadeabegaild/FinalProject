<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\RentedVehicle;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Mail\RentRequestMail;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;

class RentedVehicleController extends Controller
{
    public function index()
    {
        $rentedVehicle = RentedVehicle::with('vehicles')
            ->where('user_id', Auth::id())
            ->where('status', 'pending') // Only show pending requests
            ->get();

        foreach ($rentedVehicle as $rented) {
            $rented->rented_date = Carbon::parse($rented->rented_date);
        }

        return view('customer.rentedVehicle.index', compact('rentedVehicle'));
    }

    public function history()
    {
        // Fetch both approved and rejected borrowed equipment for the logged-in user
        $approvedVehicle = RentedVehicle::with('vehicles')
            ->where('user_id', Auth::id())
            ->where('status', 'approved') // Only show approved requests
            ->get();

        $rejectedVehicle = RentedVehicle::with('vehicles')
            ->where('user_id', Auth::id())
            ->where('status', 'rejected') // Only show rejected requests
            ->get();

            $returnedVehicle = RentedVehicle::with('vehicles')
            ->where('user_id', Auth::id())
            ->where('returned', '1') // Only show rejected requests
            ->get();

        return view('customer.rentedVehicle.history', compact('approvedVehicle', 'rejectedVehicle', 'returnedVehicle'));
    }

    public function create(Vehicle $vehicle)
    {
        $vehicles = Vehicle::all();
        return view('customer.rentedVehicle.create', compact('vehicles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'vehicles_id' => 'required|exists:vehicles,id',
            'rented_date' => 'required|date',
        ]);

        $rentedVehicle = RentedVehicle::create([
            'vehicles_id' => $request->vehicles_id,
            'user_id' => Auth::id(),
            'rented_date' => $request->rented_date,
            'status' => 'pending',
        ]);

        // Fetch the admin email
        $adminEmail = User::where('role', 'admin')->value('email');

        // Get details for the email
        $customerName = Auth::user()->name;
        $vehicleName = $rentedVehicle->vehicles->name;
        $rentedDate = $rentedVehicle->rented_date;

        // Send email notification to the admin
        Mail::to($adminEmail)->send(new RentRequestMail($customerName, $vehicleName, $rentedDate));

        return redirect()->route('customer.rentedVehicle.index')->with('success', 'Rent request submitted successfully.');
    }

    public function update(Request $request, $id)
    {
        // Find the rented vehicle by its ID
        $rentedVehicle = RentedVehicle::find($id);

        if (!$rentedVehicle) {
            return redirect()->back()->with('error', 'Vehicle not found.');
        }

        // Update the status (or any other fields based on your logic)
        $rentedVehicle->status = $request->input('status');
        $rentedVehicle->save();

        return redirect()->route('rentedVehicle.index')->with('success', 'Status updated successfully.');
    }

    public function destroy(RentedVehicle $rentedVehicle)
    {
        $rentedVehicle->delete();
        return redirect()->route('customer.rentedVehicle.index')->with('success', 'Rent request canceled successfully.');
    }

    public function destroyHistory(RentedVehicle $rentedVehicle)
    {
        $rentedVehicle->delete();
        return redirect()->route('customer.rentedVehicle.history')->with('success', 'Rent history record deleted successfully.');
    }
}