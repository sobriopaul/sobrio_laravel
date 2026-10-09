@extends('layouts.app')

@section('title', 'Appointments')

@section('content')
    <h3>List of Appointments</h3>

    <a href="{{ route('appointments.create') }}" class="btn btn-primary">Add Appointment</a>

    <table class="table">
        <thead>
            <tr>
                <th>Patient</th>
                <th>Doctor</th>
                <th>Appointment Date</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($appointments as $appointment)
                <tr>
                    <td>{{ $appointment->patient->name }}</td>
                    <td>{{ $appointment->doctor->name }}</td>
                    <td>{{ $appointment->appointment_date }}</td>
                    <td>{{ $appointment->status }}</td>
                    <td>
                        <a href="{{ route('appointments.edit', $appointment) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('appointments.destroy', $appointment) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this appointment?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="5">No appointments found. Add an appointment to get started.</td></tr>
            @endforelse
        </tbody>
    </table>
@endsection
