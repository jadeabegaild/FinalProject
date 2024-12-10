<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\RentedVehicle;
use Illuminate\Http\Request;
use App\Mail\RentRequestStatusMail;
use Illuminate\Support\Facades\Mail;

class RentedVehicleController extends Controller
{
    public function index(Request $request)
    {
        // Get search parameters
        $search = $request->input('search');

        // Query for borrowed equipment
        $pending = RentedVehicle::with('vehicles', 'user')
            ->where('status', 'pending');

        $approved = RentedVehicle::with('vehicles', 'user')
            ->where('status', 'approved');

        $rejected = RentedVehicle::with('vehicles', 'user')
            ->where('status', 'rejected');
            
        $returned = RentedVehicle::with('vehicles', 'user')
            ->where('returned', '1');

        // Apply search filter to all queries
        if ($search) {
            $pending->where(function ($query) use ($search) {
                $query->whereHas('user', function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%");
                })->orWhereHas('vehicles', function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%");
                });
            });

            $approved->where(function ($query) use ($search) {
                $query->whereHas('user', function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%");
                })->orWhereHas('vehicles', function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%");
                });
            });

            $rejected->where(function ($query) use ($search) {
                $query->whereHas('user', function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%");
                })->orWhereHas('vehicles', function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%");
                });
            });

            $returned->where(function ($query) use ($search) {
                $query->whereHas('user', function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%");
                })->orWhereHas('vehicles', function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%");
                });
            });
        }

        // Paginate results
        $pending = $pending->paginate(10);
        $approved = $approved->paginate(10);
        $rejected = $rejected->paginate(10);
        $returned = $returned->paginate(10);

        return view('admin.rentedVehicle.index', compact('pending', 'approved', 'rejected', 'returned', 'search'));
    }

    public function update(Request $request, RentedVehicle $rentedVehicle)
    {
        $request->validate([
            'status' => 'nullable|in:approved,rejected', // Update: optional status
            'returned' => 'nullable|boolean', // Add validation for the "returned" field
        ]);

        // Check if the "returned" flag is set, and update if true
        if ($request->has('returned')) {
            $rentedVehicle->update(['returned' => $request->returned]);
        }

        // If a status is provided, update it (approved or rejected)
        if ($request->has('status')) {
            $rentedVehicle->update(['status' => $request->status]);
        }

        // Get details for the email
        $userName = $rentedVehicle->user->name;
        $userEmail = $rentedVehicle->user->email;
        $vehicleName = $rentedVehicle->vehicles->name;
        $rentedDate = $rentedVehicle->rented_date;
        $status = $request->status;

        // Send email notification to the user if the status is updated
        if ($request->has('status')) {
            Mail::to($userEmail)->send(new RentRequestStatusMail($userName, $vehicleName, $rentedDate, $status));
        }

        // Send email notification to the user if the vehicle is marked as returned
        if ($request->has('returned') && $request->returned == 1) {
            // Optionally add a message for the returned status notification.
            Mail::to($userEmail)->send(new RentRequestStatusMail($userName, $vehicleName, $rentedDate, 'returned'));
        }

        return redirect()->route('rentedVehicle.index')->with('success', 'Rent request updated and user notified successfully.');
    }
}