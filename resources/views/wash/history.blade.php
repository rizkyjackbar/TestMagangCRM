<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Transaksi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container my-4">
        <h1 class="text-center mb-4">Riwayat Transaksi</h1>

        <!-- Tampilkan info customer -->
        <div class="card mb-4">
            <div class="card-header">
                Informasi Pelanggan
            </div>
            <div class="card-body">
                <p>Nama: {{ $customer->name }}</p>
                <p>Nomor HP: {{ $customer->phone }}</p>
                <p>Total Transaksi: {{ $transactions->count() }} kali</p>
            </div>
        </div>

        <!-- Tampilkan riwayat transaksi -->
        <div class="card">
            <div class="card-header">
                Riwayat Transaksi
            </div>
            <div class="card-body">
                @if($transactions->isEmpty())
                    <p class="text-center">Belum ada transaksi.</p>
                @else
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Tanggal</th>
                                <th>Kendaraan</th>
                                <th>Harga</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($transactions as $transaction)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $transaction->created_at->format('d M Y H:i') }}</td>
                                    <td>{{ $transaction->vehicle->type }}</td>
                                    <td>Rp {{ number_format($transaction->amount, 0, ',', '.') }}</td>
                                </tr>
                            @endforeach
                        </tbody>                        
                    </table>
                @endif
            </div>
        </div>

        <!-- Kembali ke halaman utama -->
        <div class="text-center mt-4">
            <a href="{{ route('home') }}" class="btn btn-primary">Kembali</a>
        </div>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
</body>
</html>
