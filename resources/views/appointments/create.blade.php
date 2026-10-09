@extends('layouts.app')

@section('title', 'Add Appointment')

@section('content')
    <div class="card shadow-sm">
        <div class="card-header bg-white"><h1 class="h4 mb-0">Add appointment</h1></div>
        <div class="card-body">
            @include('appointments._form', ['action' => route('appointments.store'), 'method' => 'POST'])
        </div>
    </div>
@endsection
