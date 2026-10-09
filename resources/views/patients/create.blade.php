@extends('layouts.app')

@section('title', 'Add Patient')

@section('content')
    <div class="card shadow-sm">
        <div class="card-header bg-white"><h1 class="h4 mb-0">Add patient</h1></div>
        <div class="card-body">
            @include('patients._form', ['action' => route('patients.store'), 'method' => 'POST'])
        </div>
    </div>
@endsection
