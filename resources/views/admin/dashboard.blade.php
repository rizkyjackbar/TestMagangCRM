@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('content')
    <div class="container mt-5">
        <h1 class="text-center mb-4">Admin Dashboard</h1>

        <!-- Customer -->
        <div class="mt-5">
            <div class="d-flex justify-content-between align-items-center">
                <h2>Pelanggan CRM-Wash</h2>
                <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addCustomerModal">Tambah Customer
                    Baru</button>
            </div>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nama</th>
                        <th>Nomor HP</th>
                        <th>Dibuat Pada</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($customers as $customer)
                        <tr>
                            <td>{{ $customer->id }}</td>
                            <td>{{ $customer->name }}</td>
                            <td>{{ $customer->phone }}</td>
                            <td>{{ $customer->created_at }}</td>
                            <td>
                                <a href="{{ route('admin.customers.edit', $customer->id) }}"
                                    class="btn btn-warning btn-sm">Edit</a>
                                <button class="btn btn-danger btn-sm"
                                    onclick="confirmDeleteCustomer({{ $customer->id }})">Delete</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Vehicles -->
        <div class="mt-5">
            <div class="d-flex justify-content-between align-items-center">
                <h2>Tipe Kendaraan</h2>
                <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addVehicleModal">Tambah Vehicle
                    Baru</button>
            </div>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Tipe</th>
                        <th>CC</th>
                        <th>Harga Cuci</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($vehicles as $vehicle)
                        <tr>
                            <td>{{ $vehicle->id }}</td>
                            <td>{{ $vehicle->type }}</td>
                            <td>{{ $vehicle->cc }}</td>
                            <td>{{ $vehicle->price }}</td>
                            <td>
                                <a href="{{ route('admin.vehicles.edit', $vehicle->id) }}"
                                    class="btn btn-warning btn-sm">Edit</a>
                                <button class="btn btn-danger btn-sm"
                                    onclick="confirmDeleteVehicle({{ $vehicle->id }})">Delete</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Tabel Transaksi -->
        <div class="mt-5">
            <h2>Riwayat Semua Transaksi</h2>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Customer</th>
                        <th>Harga</th>
                        <th>Tanggal</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($transactions as $transaction)
                        <tr>
                            <td>{{ $transaction->id }}</td>
                            <td>{{ $transaction->customer->name }}</td>
                            <td>{{ $transaction->amount }}</td>
                            <td>{{ $transaction->created_at }}</td>
                            <td>{{ $transaction->status }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- add Customer -->
    <div class="modal fade" id="addCustomerModal" tabindex="-1" aria-labelledby="addCustomerModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addCustomerModalLabel">Tambah Customer Baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('admin.customers.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="customer_name" class="form-label">Nama:</label>
                            <input type="text" id="customer_name" name="name" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="customer_phone" class="form-label">Nomor HP:</label>
                            <input type="text" id="customer_phone" name="phone" class="form-control" required>
                        </div>
                        <button type="submit" class="btn btn-success">Tambah Customer</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- add Vehicle -->
    <div class="modal fade" id="addVehicleModal" tabindex="-1" aria-labelledby="addVehicleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addVehicleModalLabel">Tambah Vehicle Baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('admin.vehicles.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="vehicle_type" class="form-label">Type:</label>
                            <input type="text" id="vehicle_type" name="type" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="vehicle_cc" class="form-label">CC:</label>
                            <input type="number" id="vehicle_cc" name="cc" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="vehicle_price" class="form-label">Price:</label>
                            <input type="text" id="vehicle_price" name="price" class="form-control" required>
                        </div>
                        <button type="submit" class="btn btn-success">Tambah Vehicle</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!--  Alert  -->
    <div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style="background-color: #d4edda; border: 1px solid;">
                <div class="modal-body text-center">
                    <p id="successMessage" class="mb-0" style="font-weight: bold;"></p>
                </div>
            </div>
        </div>
    </div>

    <!-- Konfirmasi Delete Customer -->
    <div class="modal fade" id="deleteCustomerModal" tabindex="-1" aria-labelledby="deleteCustomerModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style="background-color: #f5f5f5; border: 1px solid;">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteCustomerModalLabel">Konfirmasi Hapus Customer</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center">
                    <p style="font-weight: bold;">Apakah Anda yakin ingin menghapus customer ini?</p>
                    <form id="deleteCustomerForm" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Hapus</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- hapus Vehicle -->
    <div class="modal fade" id="deleteVehicleModal" tabindex="-1" aria-labelledby="deleteVehicleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style="background-color: #f5f5f5; border: 1px solid;">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteVehicleModalLabel">Konfirmasi Hapus Vehicle</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center">
                    <p style="font-weight: bold;">Apakah Anda yakin ingin menghapus vehicle ini?</p>
                    <form id="deleteVehicleForm" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Hapus</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="my-5">
        <h2>Ringkasan Statistik</h2>
        <div class="row">
            <div class="col-md-3">
                <div class="card text-white bg-primary mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Total Customer Terdaftar</h5>
                        <p class="card-text">{{ $customers->count() }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card text-white bg-success mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Customer dengan Transaksi</h5>
                        <p class="card-text">{{ $transactions->unique('customer_id')->count() }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card text-white bg-info mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Total Pendapatan</h5>
                        <p class="card-text">Rp {{ number_format($transactions->sum('amount'), 0, ',', '.') }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card text-white bg-warning mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Customer Mendapat Promo</h5>
                        <p class="card-text">{{ $transactions->where('status', 'promo')->count() }}</p>
                    </div>
                </div>
            </div>
        </div>
        {{-- <h4 class="mt-4">Jenis Kendaraan yang Digunakan dalam Transaksi</h4>
        <ul>
            @foreach ($vehicles->pluck('type')->unique() as $vehicleType)
                <li>{{ $vehicleType }}</li>
            @endforeach
        </ul> --}}
    </div>


@endsection

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            @if (session('success'))
                var successModal = new bootstrap.Modal(document.getElementById('successModal'), {
                    keyboard: false,
                    backdrop: 'static'
                });

                document.getElementById('successMessage').innerText = "{{ session('success') }}";
                successModal.show();

                setTimeout(function() {
                    successModal.hide();
                }, 2000);
            @endif
        });

        function confirmDeleteCustomer(id) {
            var deleteForm = document.getElementById('deleteCustomerForm');
            deleteForm.action = '/admin/customers/' + id;

            var deleteModal = new bootstrap.Modal(document.getElementById('deleteCustomerModal'), {
                keyboard: false,
                backdrop: 'static'
            });
            deleteModal.show();
        }

        function confirmDeleteVehicle(id) {
            var deleteForm = document.getElementById('deleteVehicleForm');
            deleteForm.action = '/admin/vehicles/' + id;

            var deleteModal = new bootstrap.Modal(document.getElementById('deleteVehicleModal'), {
                keyboard: false,
                backdrop: 'static'
            });
            deleteModal.show();
        }
    </script>
@endsection
