@extends('layouts.app')

@section('title', 'Edit Customer')

@section('content')
<div class="container mt-5">
    <h1 class="text-center mb-4">Edit Customer</h1>

    <form action="{{ route('admin.customers.update', $customer->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="customer_name" class="form-label">Nama:</label>
            <input type="text" id="customer_name" name="name" class="form-control" value="{{ $customer->name }}" required>
        </div>
        <div class="mb-3">
            <label for="customer_phone" class="form-label">Nomor HP:</label>
            <input type="text" id="customer_phone" name="phone" class="form-control" value="{{ $customer->phone }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Update Customer</button>
    </form>
</div>
@endsection
