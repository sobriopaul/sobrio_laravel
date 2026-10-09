<?php

namespace Tests\Feature;

use App\Models\Appointment;
use App\Models\Doctor;
use App\Models\Patient;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ClinicCrudTest extends TestCase
{
    use RefreshDatabase;

    public function test_doctors_patients_and_appointments_support_crud(): void
    {
        $this->get(route('doctors.index'))->assertOk()->assertSee('Doctors');
        $this->get(route('patients.index'))->assertOk()->assertSee('Patients');
        $this->get(route('appointments.index'))->assertOk()->assertSee('Appointments');
        $this->get(route('doctors.create'))->assertOk()->assertSee('Add doctor');
        $this->get(route('patients.create'))->assertOk()->assertSee('Add patient');
        $this->get(route('appointments.create'))->assertOk()->assertSee('Add appointment');

        $this->post(route('doctors.store'), [
            'name' => 'Avery Smith',
            'specialization' => 'Family Medicine',
            'email' => 'avery@example.test',
            'phone' => '555-0100',
        ])->assertRedirect(route('doctors.index'));
        $doctor = Doctor::firstOrFail();

        $this->post(route('patients.store'), [
            'student_id' => 'STU-100',
            'name' => 'Jordan Lee',
            'course' => 'Nursing',
            'year_level' => 2,
        ])->assertRedirect(route('patients.index'));
        $patient = Patient::firstOrFail();

        $this->post(route('appointments.store'), [
            'patient_id' => $patient->id,
            'doctor_id' => $doctor->id,
            'appointment_date' => '2026-10-08',
            'status' => 'Scheduled',
        ])->assertRedirect(route('appointments.index'));
        $appointment = Appointment::firstOrFail();

        $this->get(route('doctors.edit', $doctor))->assertOk()->assertSee('Edit doctor');
        $this->get(route('patients.edit', $patient))->assertOk()->assertSee('Edit patient');
        $this->get(route('appointments.edit', $appointment))->assertOk()->assertSee('Edit appointment');

        $this->get(route('doctors.index'))->assertSee('Avery Smith');
        $this->get(route('patients.index'))->assertSee('Jordan Lee');
        $this->get(route('appointments.index'))
            ->assertSee('Jordan Lee')
            ->assertSee('Avery Smith')
            ->assertSee('Scheduled');

        $this->put(route('doctors.update', $doctor), [
            'name' => 'Avery Jones',
            'specialization' => 'Pediatrics',
            'email' => 'avery@example.test',
            'phone' => '555-0101',
        ])->assertRedirect(route('doctors.index'));

        $this->put(route('patients.update', $patient), [
            'student_id' => 'STU-101',
            'name' => 'Jordan Kim',
            'course' => 'Medicine',
            'year_level' => 3,
        ])->assertRedirect(route('patients.index'));

        $this->put(route('appointments.update', $appointment), [
            'patient_id' => $patient->id,
            'doctor_id' => $doctor->id,
            'appointment_date' => '2026-10-09',
            'status' => 'Completed',
        ])->assertRedirect(route('appointments.index'));

        $this->assertDatabaseHas('doctors', ['id' => $doctor->id, 'name' => 'Avery Jones']);
        $this->assertDatabaseHas('patients', ['id' => $patient->id, 'student_id' => 'STU-101']);
        $this->assertDatabaseHas('appointments', ['id' => $appointment->id, 'status' => 'Completed']);

        $this->delete(route('appointments.destroy', $appointment))->assertRedirect(route('appointments.index'));
        $this->delete(route('patients.destroy', $patient))->assertRedirect(route('patients.index'));
        $this->delete(route('doctors.destroy', $doctor))->assertRedirect(route('doctors.index'));

        $this->assertDatabaseMissing('appointments', ['id' => $appointment->id]);
        $this->assertDatabaseMissing('patients', ['id' => $patient->id]);
        $this->assertDatabaseMissing('doctors', ['id' => $doctor->id]);
    }
}
