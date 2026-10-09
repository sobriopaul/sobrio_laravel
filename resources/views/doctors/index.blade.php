@extends('layouts.app')

@section('title', 'Doctors')

@section('content')
    <h3>List of Doctors</h3>

    <a href="{{ route('doctors.create') }}" class="btn btn-primary">Add Doctor</a>

    <table class="table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Specialization</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($doctors as $doctor)
                <tr>
                    <td>{{ $doctor->name }}</td>
                    <td>{{ $doctor->specialization }}</td>
                    <td>{{ $doctor->email }}</td>
                    <td>{{ $doctor->phone }}</td>
                    <td>
                        <a href="{{ route('doctors.edit', $doctor) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('doctors.destroy', $doctor) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this doctor?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="5">No doctors found. Run <code>php artisan db:seed</code> to load the sample doctors.</td></tr>
            @endforelse
        </tbody>
    </table>
@endsection
