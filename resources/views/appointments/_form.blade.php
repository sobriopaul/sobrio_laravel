@if($errors->any())
    <div class="alert alert-danger"><ul class="mb-0">@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul></div>
@endif

@if($patients->isEmpty() || $doctors->isEmpty())
    <div class="alert alert-warning">
        Add at least one patient and one doctor before creating an appointment.
        @if($patients->isEmpty())
            <a href="{{ route('patients.create') }}" class="alert-link">Add a patient</a>
        @endif
        @if($patients->isEmpty() && $doctors->isEmpty()) and @endif
        @if($doctors->isEmpty())
            <a href="{{ route('doctors.create') }}" class="alert-link">add a doctor</a>
        @endif
    </div>
@endif

<form action="{{ $action }}" method="POST">
    @csrf
    @if($method !== 'POST')
        @method($method)
    @endif
    <div class="mb-3">
        <label for="patient_id" class="form-label">Patient</label>
        <select id="patient_id" name="patient_id" class="form-select" required>
            <option value="">Select a patient</option>
            @foreach($patients as $patient)
                <option value="{{ $patient->id }}" @selected(old('patient_id', $appointment->patient_id ?? '') == $patient->id)>{{ $patient->name }} ({{ $patient->student_id }})</option>
            @endforeach
        </select>
    </div>
    <div class="mb-3">
        <label for="doctor_id" class="form-label">Doctor</label>
        <select id="doctor_id" name="doctor_id" class="form-select" required>
            <option value="">Select a doctor</option>
            @foreach($doctors as $doctor)
                <option value="{{ $doctor->id }}" @selected(old('doctor_id', $appointment->doctor_id ?? '') == $doctor->id)>{{ $doctor->name }} ({{ $doctor->specialization }})</option>
            @endforeach
        </select>
    </div>
    <div class="mb-3">
        <label for="appointment_date" class="form-label">Appointment date</label>
        <input id="appointment_date" type="date" name="appointment_date" value="{{ old('appointment_date', $appointment->appointment_date ?? '') }}" class="form-control" required>
    </div>
    <div class="mb-3">
        <label for="status" class="form-label">Status</label>
        <select id="status" name="status" class="form-select" required>
            @foreach(['Scheduled', 'Completed', 'Cancelled'] as $status)
                <option value="{{ $status }}" @selected(old('status', $appointment->status ?? 'Scheduled') === $status)>{{ $status }}</option>
            @endforeach
        </select>
    </div>
    <button type="submit" class="btn btn-primary" @disabled($patients->isEmpty() || $doctors->isEmpty())>{{ $method === 'POST' ? 'Save appointment' : 'Update appointment' }}</button>
    <a href="{{ route('appointments.index') }}" class="btn btn-outline-secondary">Cancel</a>
</form>
