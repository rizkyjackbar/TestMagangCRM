<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;

class CustomerController extends Controller
{
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'phone' => 'required|unique:customers,phone',
            'name' => 'required|string',
        ]);

        // Simpan customer baru
        Customer::create([
            'phone' => $request->phone,
            'name' => $request->name,
        ]);

        return redirect()->back()->with('message', 'Nomor telepon berhasil didaftarkan.');
    }
}
