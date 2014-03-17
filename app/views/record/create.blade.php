@extends('layout')

@section('title')
Upload Record
@stop

@section('content')
@include('error')

{{ Form::open(array('route' => 'record.store', 'class' => 'pure-form pure-form-aligned')) }}
  {{ Form::hidden('radiologist_id', Auth::user()->person->person_id) }} 
  <div class="pure-control-group">
    {{ Form::label('patient_id', "Patient") }}
    {{ Form::select('patient_id', $patients) }}
  </div>
  
  <div class="pure-control-group">
    {{ Form::label('doctor_id', "Doctor") }}
    {{ Form::select('doctor_id', array()) }}
  </div>
  
  <div class="pure-control-group">
    {{ Form::label('test_type') }}
    {{ Form::select('test_type', Record::$TEST_TYPES) }}
  </div>
  <div class="pure-control-group">
    {{ Form::label('prescribing_date') }}
    {{ Form::input('date', 'prescribing_date') }}
  </div>
  <div class="pure-control-group">
    {{ Form::label('test_date') }}
    {{ Form::input('date', 'test_date') }}
  </div>
  
  <div class="pure-control-group">
    {{ Form::label('diagnosis') }}
    {{ Form::text('diagnosis') }}
  </div>

  <div class="pure-control-group">
    {{ Form::label('description') }}
    {{ Form::textarea('description') }}
  </div>

  <div class="pure-controls">
    <input type="submit" value="Create" class="pure-button pure-button-good" />
  </div>
{{ Form::close() }}

@stop
