@extends('layouts.app')

@section('title', 'Edit Doctor')

@section('content')
    <div class="card shadow-sm">
        <div class="card-header bg-white"><h1 class="h4 mb-0">Edit doctor</h1></div>
        <div class="card-body">
            @if($errors->any())
                <div class="alert alert-danger"><ul class="mb-0">@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul></div>
            @endif

            <form action="{{ route('doctors.update', $doctor) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input id="name" name="name" value="{{ old('name', $doctor->name) }}" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="specialization" class="form-label">Specialization</label>
                    <input id="specialization" name="specialization" value="{{ old('specialization', $doctor->specialization) }}" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input id="email" type="email" name="email" value="{{ old('email', $doctor->email) }}" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="phone" class="form-label">Phone</label>
                    <input id="phone" name="phone" value="{{ old('phone', $doctor->phone) }}" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary">Update doctor</button>
                <a href="{{ route('doctors.index') }}" class="btn btn-outline-secondary">Cancel</a>
            </form>
        </div>
    </div>
@endsection
