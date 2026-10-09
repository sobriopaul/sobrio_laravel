@extends('layouts.app')

@section('title', 'Edit Patient')

@section('content')
    <div class="card shadow-sm">
        <div class="card-header bg-white"><h1 class="h4 mb-0">Edit patient</h1></div>
        <div class="card-body">
            @include('patients._form', ['action' => route('patients.update', $patient), 'method' => 'PUT'])
        </div>
    </div>
@endsection
