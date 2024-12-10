<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\RentedVehicle;

use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class VehicleController extends Controller
{
    public function index()
    {
        $vehicles = Vehicle::all();
        return view('admin.vehicle.index', compact('vehicles'));
    }


    public function create()
    {
        // You might want to pass additional data to the view, such as categories or other related models
        return view('admin.vehicle.create');  // Make sure the 'create' view exists in resources/views/admin/vehicles
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'picture' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
        ]);

        $picturePath = null;
        if ($request->hasFile('picture')) {
            $picturePath = $request->file('picture')->store('vehicles', 'public');
        }

        Vehicle::create([
            'id' => $request->id,
            'name' => $request->name,
            'picture' => $picturePath,
            'description' => $request->description,
            'price' => $request->price,
        ]);

        return redirect()->route('vehicle.index')->with('success', 'Vehicle created successfully.');
    }

    public function edit($id)
{
    // Get the vehicle by its ID
    $vehicle = Vehicle::findOrFail($id);

    // Return the edit view with the vehicle data
    return view('admin.vehicle.edit', compact('vehicle'));
}


    public function update(Request $request, Vehicle $vehicles, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'price' => 'required|numeric',
            'picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
    
        // Find the vehicle by ID
        $vehicle = Vehicle::findOrFail($id);
    
        // Update the vehicle's attributes
        $vehicle->name = $request->input('name');
        $vehicle->description = $request->input('description');
        $vehicle->price = $request->input('price');
    
        // Handle the picture upload if a new file is provided
        if ($request->hasFile('picture')) {
            // Delete the old picture if it exists
            if ($vehicle->picture) {
                Storage::delete($vehicle->picture);
            }
            // Store the new picture and update the vehicle's picture attribute
            $vehicle->picture = $request->file('picture')->store('vehicles');
        }
    
        // Save the updated vehicle
        $vehicle->save();
    
        // Redirect back with a success message
        return redirect()->route('vehicle.index')->with('success', 'Vehicle updated successfully.');
    }
        public function destroy(Vehicle $vehicle)
        {
            if ($vehicle->picture) {
                Storage::delete($vehicle->picture);
            }
            $vehicle->delete();
            return redirect()->route('vehicle.index')->with('success', 'Vehicle deleted successfully.');
        }

}