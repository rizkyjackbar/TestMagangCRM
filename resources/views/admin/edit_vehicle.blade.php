@extends('layouts.app')

@section('title', 'Edit Vehicle')

@section('content')
<div class="container mt-5">
    <h1 class="text-center mb-4">Edit Vehicle</h1>

    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('admin.vehicles.update', $vehicle->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="vehicle_type" class="form-label">Type:</label>
                            <input type="text" id="vehicle_type" name="type" class="form-control" value="{{ $vehicle->type }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="vehicle_cc" class="form-label">CC:</label>
                            <input type="number" id="vehicle_cc" name="cc" class="form-control" value="{{ $vehicle->cc }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="vehicle_price" class="form-label">Price:</label>
                            <input type="text" id="vehicle_price" name="price" class="form-control" value="{{ $vehicle->price }}" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Update Vehicle</button>
                        <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
