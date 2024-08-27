<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\Vehicle;
use App\Models\Transaction;

class WashController extends Controller
{
    public function index()
    {
        $customers = Customer::all();
        $vehicles = Vehicle::all();
        return view('wash.index', compact('customers', 'vehicles'));
    }

    // transaksi
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'phone' => 'required|string',
            'name' => 'required|string',
            'vehicle_id' => 'required|exists:vehicles,id',
        ]);

        // Cari customer berdasarkan nomor telepon
        $customer = Customer::where('phone', $request->phone)->first();

        // Jika customer belum terdaftar, berikan pesan kesalahan
        if (!$customer) {
            return redirect()->back()->with('error', 'Nomor telepon belum terdaftar. Silakan daftar terlebih dahulu.');
        }

        // Jika customer ditemukan, lanjutkan proses
        $customer->name = $request->name;
        $customer->save();

        // Dapatkan data kendaraan berdasarkan vehicle_id
        $vehicle = Vehicle::find($request->vehicle_id);

        // Buat transaksi baru
        $transaction = new Transaction();
        $transaction->customer()->associate($customer);
        $transaction->vehicle()->associate($vehicle);

        $transaction->save();

        // Cek apakah customer mendapatkan cuci gratis
        $transactionCount = $customer->transactions()->count();
        $isFreeWash = $transactionCount % 5 === 0;

        $message = $isFreeWash ? 'Selamat! Anda mendapatkan cuci gratis pada transaksi ini.' : 'Transaksi berhasil!';

        return redirect()->back()->with('message', $message)->with('isFreeWash', $isFreeWash);
    }

    // riwayat transaksi
    public function history(Request $request)
    {
        // Cari customer berdasarkan nomor telepon
        $customer = Customer::where('phone', $request->phone)->first();

        if (!$customer) {
            // Jika nomor telepon tidak ditemukan
            return redirect()->back()->with('error', 'Nomor telepon tidak ditemukan.');
        }

        // Ambil semua transaksi terkait customer tersebut
        $transactions = $customer->transactions()->with('vehicle')->get();

        return view('wash.history', compact('customer', 'transactions'));
    }
}
