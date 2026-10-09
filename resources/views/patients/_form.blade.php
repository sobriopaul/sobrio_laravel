@if($errors->any())
    <div class="alert alert-danger"><ul class="mb-0">@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul></div>
@endif

<form action="{{ $action }}" method="POST">
    @csrf
    @if($method !== 'POST')
        @method($method)
    @endif
    <div class="mb-3">
        <label for="student_id" class="form-label">Student ID</label>
        <input id="student_id" name="student_id" value="{{ old('student_id', $patient->student_id ?? '') }}" class="form-control" required>
    </div>
    <div class="mb-3">
        <label for="name" class="form-label">Name</label>
        <input id="name" name="name" value="{{ old('name', $patient->name ?? '') }}" class="form-control" required>
    </div>
    <div class="mb-3">
        <label for="course" class="form-label">Course</label>
        <input id="course" name="course" value="{{ old('course', $patient->course ?? '') }}" class="form-control" required>
    </div>
    <div class="mb-3">
        <label for="year_level" class="form-label">Year level</label>
        <input id="year_level" type="number" min="1" max="20" name="year_level" value="{{ old('year_level', $patient->year_level ?? '') }}" class="form-control" required>
    </div>
    <button type="submit" class="btn btn-primary">{{ $method === 'POST' ? 'Save patient' : 'Update patient' }}</button>
    <a href="{{ route('patients.index') }}" class="btn btn-outline-secondary">Cancel</a>
</form>
