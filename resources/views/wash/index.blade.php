<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRM-Wash</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        .modal-dialog-centered {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .modal-backdrop {
            background-color: rgba(0, 0, 0, 0.7) !important;
        }
    </style>
</head>

<body>
    <div class="container mt-5">
        <h1 class="text-center mb-4">CRM-Wash</h1>

        <div class="d-flex justify-content-between align-items-center">
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#registerModal">Daftarkan Nomor
                HP</button>
            <button class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#adminLoginModal">Admin
                Login</button>
        </div>
        <div class="text-right mb-4">

        </div>


        <!-- Form Transaksi -->
        <div class="card mb-4" id="transactionForm">
            <div class="card-header">
                Input Transaksi
            </div>
            <div class="card-body">
                <form action="{{ route('transaction.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="phone" class="form-label">Nomor HP :</label>
                        <input type="text" id="phone" name="phone" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="name" class="form-label">Nama :</label>
                        <input type="text" id="name" name="name" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="vehicle_id" class="form-label">Pilih Kendaraan:</label>
                        <select id="vehicle_id" name="vehicle_id" class="form-select" required>
                            <option value="">-- Pilih Kendaraan --</option>
                            @foreach ($vehicles as $vehicle)
                                <option value="{{ $vehicle->id }}" data-price="{{ $vehicle->price }}">
                                    {{ $vehicle->type }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="price" class="form-label">Harga:</label>
                        <input type="text" id="price" class="form-control" readonly>
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan Transaksi</button>
                </form>
            </div>
        </div>

        <!-- Modal Popup Pendaftaran Nomor Telepon -->
        <div class="modal fade" id="registerModal" tabindex="-1" aria-labelledby="registerModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="registerModalLabel">Form Input Nomor HP</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('customer.store') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="register_phone" class="form-label">Nomor HP:</label>
                                <input type="text" id="register_phone" name="phone" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="register_name" class="form-label">Nama:</label>
                                <input type="text" id="register_name" name="name" class="form-control" required>
                            </div>
                            <button type="submit" class="btn btn-success">Daftarkan Nomor</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Admin Login -->
        <div class="modal fade" id="adminLoginModal" tabindex="-1" aria-labelledby="adminLoginModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="adminLoginModalLabel">Admin Login</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('admin.login') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="admin_username" class="form-label">Username:</label>
                                <input type="text" id="admin_username" name="username" class="form-control"
                                    required>
                            </div>
                            <div class="mb-3">
                                <label for="admin_password" class="form-label">Password:</label>
                                <input type="password" id="admin_password" name="password" class="form-control"
                                    required>
                            </div>
                            <button type="submit" class="btn btn-primary">Login</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>


        <!-- Form untuk melihat riwayat transaksi -->
        <div class="card mb-4">
            <div class="card-header">
                Cek Riwayat Transaksi
            </div>
            <div class="card-body">
                <form action="{{ route('transaction.history') }}" method="GET">
                    <div class="mb-3">
                        <label for="history_phone" class="form-label">Masukkan Nomor HP:</label>
                        <input type="text" id="history_phone" name="phone" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Lihat Riwayat</button>
                </form>
            </div>
        </div>

        <!-- alert -->
        <div class="modal fade" id="alertModal" tabindex="-1" aria-labelledby="alertModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-body">
                        @if (session('error'))
                            <p class="text-danger">{{ session('error') }}</p>
                        @elseif(session('isFreeWash'))
                            <p class="text-success">{{ session('message') }}</p>
                        @else
                            <p>{{ session('message') }}</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>

    <script>
        $(document).ready(function() {
            // harga ketika kendaraan dipilih
            $('#vehicle_id').change(function() {
                var price = $(this).find(':selected').data('price');
                var formattedPrice = new Intl.NumberFormat('id-ID', {
                    style: 'currency',
                    currency: 'IDR',
                    minimumFractionDigits: 0
                }).format(price);

                $('#price').val(formattedPrice);
            });


            // cek nomor telepon terdaftar
            $('#phone').blur(function() {
                var phone = $(this).val();
                $.ajax({
                    url: '/check-phone', // route cek nomor telepon
                    method: 'GET',
                    data: {
                        phone: phone
                    },
                    success: function(response) {
                        if (!response.exists) {
                            alert(
                                'Nomor telepon belum terdaftar. Silakan daftar terlebih dahulu.'
                            );
                            $('#transactionForm').hide();
                        } else {
                            $('#transactionForm').show();
                        }
                    }
                });
            });

            @if (session('message') || session('error'))
                var alertModal = new bootstrap.Modal(document.getElementById('alertModal'), {
                    keyboard: false,
                    backdrop: 'static'
                });
                alertModal.show();

                setTimeout(function() {
                    alertModal.hide();
                }, 2000);
            @endif
        });
    </script>
</body>

</html>
