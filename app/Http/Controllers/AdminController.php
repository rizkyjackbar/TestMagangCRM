<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Customer;
use App\Models\Vehicle;
use App\Models\Transaction;

class AdminController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only('username', 'password');

        if (Auth::guard('admin')->attempt($credentials)) {

            return redirect()->route('admin.dashboard');
        }

        return redirect()->back()->with('error', 'Login failed, please check your credentials and try again.');
    }

    public function dashboard()
    {
        $customers = Customer::all();
        $vehicles = Vehicle::all();
        $transactions = Transaction::all();

        // send data ke dashboard
        return view('admin.dashboard', compact('customers', 'vehicles', 'transactions'));
    }

    // Customer
    public function storeCustomer(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:15',
        ]);

        Customer::create([
            'name' => $request->name,
            'phone' => $request->phone,
        ]);

        return redirect()->route('admin.dashboard')->with('success', 'Customer baru berhasil ditambahkan!');
    }

    public function editCustomer($id)
    {
        $customer = Customer::findOrFail($id);

        // send data customer ke view untuk edit
        return view('admin.edit_customer', compact('customer'));
    }

    public function updateCustomer(Request $request, $id)
    {
        $customer = Customer::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:15',
        ]);

        $customer->update([
            'name' => $request->name,
            'phone' => $request->phone,
        ]);

        return redirect()->route('admin.dashboard')->with('success', 'Customer berhasil diperbarui!');
    }

    public function deleteCustomer($id)
    {
        $customer = Customer::findOrFail($id);

        $customer->delete();

        return redirect()->route('admin.dashboard')->with('success', 'Customer berhasil dihapus!');
    }

    // Vehicle
    public function storeVehicle(Request $request)
    {
        $request->validate([
            'type' => 'required|string|max:255',
            'cc' => 'required|integer',
            'price' => 'required|numeric',
        ]);

        Vehicle::create([
            'type' => $request->type,
            'cc' => $request->cc,
            'price' => $request->price,
        ]);

        return redirect()->route('admin.dashboard')->with('success', 'Vehicle baru berhasil ditambahkan!');
    }

    public function editVehicle($id)
    {
        $vehicle = Vehicle::findOrFail($id);

        return view('admin.edit_vehicle', compact('vehicle'));
    }

    public function updateVehicle(Request $request, $id)
    {
        $vehicle = Vehicle::findOrFail($id);

        $request->validate([
            'type' => 'required|string|max:255',
            'cc' => 'required|integer',
            'price' => 'required|numeric',
        ]);

        $vehicle->update([
            'type' => $request->type,
            'cc' => $request->cc,
            'price' => $request->price,
        ]);

        return redirect()->route('admin.dashboard')->with('success', 'Vehicle berhasil diperbarui!');
    }

    public function deleteVehicle($id)
    {
        $vehicle = Vehicle::findOrFail($id);

        $vehicle->delete();

        return redirect()->route('admin.dashboard')->with('success', 'Vehicle berhasil dihapus!');
    }
}
