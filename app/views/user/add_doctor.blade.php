@extends('layout')

@section('title')
Add Doctor
@stop

@section('content')
@include('error')
@if ($user_doctors->count() > 0)
  <table class="pure-table">
    <thead>
      <tr>
        <th>Doctor Name</th>
        <th>Actions</th>
      </tr>
    </thead>

    @foreach ($user_doctors as $doctor)
      <tr>
        <td>{{ $doctor->full_name }}</td>
        <td>
          {{ Form::open(array('route' => array('user.remove_doctor', $patient->person_id),
                              'class' => 'pure-form')) }}
            {{ Form::hidden('doctor_id', $doctor->person_id) }}
            <input type="submit" value="Remove" class="pure-button pure-button-bad" />
          {{ Form::close() }}
        </td>
      </tr>
    @endforeach
  </table>
@endif

{{ Form::open(array('route' => 'user.store_doctor', 
                    'class' => 'pure-form pure-form-aligned')) }}
  <legend>Add doctor for {{ $patient->full_name }}</legend>
  {{ Form::hidden('patient_id', $patient->person_id) }}  
  <div class="pure-control-group">
    {{ Form::label('doctor_id', "Doctor") }}
    {{ Form::select('doctor_id', $all_doctors) }}
  </div>

  <div class="pure-controls">
    <input type="submit" value="Add Doctor" class="pure-button pure-button-good">
    <a href="{{ URL::route('user.index') }}" class="pure-button pure-button-cancel">
      Cancel
    </a>
  </div>
{{ Form::close() }}
@stop
