@extends('layouts.app')

@section('title', 'Patients')

@section('content')
    <h3>List of Patients</h3>

    <a href="{{ route('patients.create') }}" class="btn btn-primary">Add Patient</a>

    <table class="table">
        <thead>
            <tr>
                <th>Student ID</th>
                <th>Name</th>
                <th>Course</th>
                <th>Year Level</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($patients as $patient)
                <tr>
                    <td>{{ $patient->student_id }}</td>
                    <td>{{ $patient->name }}</td>
                    <td>{{ $patient->course }}</td>
                    <td>{{ $patient->year_level }}</td>
                    <td>
                        <a href="{{ route('patients.edit', $patient) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('patients.destroy', $patient) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this patient?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="5">No patients found. Add a patient to get started.</td></tr>
            @endforelse
        </tbody>
    </table>
@endsection
