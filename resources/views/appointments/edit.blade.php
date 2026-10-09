@extends('layouts.app')

@section('title', 'Edit Appointment')

@section('content')
    <div class="card shadow-sm">
        <div class="card-header bg-white"><h1 class="h4 mb-0">Edit appointment</h1></div>
        <div class="card-body">
            @include('appointments._form', ['action' => route('appointments.update', $appointment), 'method' => 'PUT'])
        </div>
    </div>
@endsection
