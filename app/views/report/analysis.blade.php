@extends('layout')

@section('title')
Data Analysis
@stop

@section('content')
  @include('error')
  {{ Form::open(array('route' => 'report.analyze', 
                      'class' => 'pure-form pure-form-aligned')) }}

    <legend>Choose Filters</legend>
    <div class="pure-control-group">
      <label class="form-label">Filter By</label>
    </div>

    <div class="pure-control-group">
      <label for="search[]">
        <input type="checkbox" name="search[]" value="patient_id" />
      </label>
      Patient
    </div>

    <div class="pure-control-group">
      <label for="search[]">
        <input type="checkbox" name="search[]" value="test_type" />
      </label>
      Test Type
    </div>

    <div class="pure-control-group">
      <label for="search[]">
        <input type="checkbox" name="search[]" value="period" />
      </label>
      Period
    </div>
    
    <legend>Specify Data</legend>
    <div class="pure-control-group">
      {{ Form::label('patient_id', "Patient") }}
      {{ Form::select('patient_id', Person::patients()) }}
    </div>

    <div class="pure-control-group">
      {{ Form::label('test_type', "Test Type") }}
      {{ Form::select('test_type', Record::$TEST_TYPES) }}
    </div>

    <div class="pure-control-group">
      {{ Form::label('period', "Period") }}
      {{ Form::select('period', array('weekly' => 'weekly', 'monthly' => 'monthly', 'yearly' => 'yearly')) }}
    </div>

    <legend>Submit and Analyze</legend>
    <div class="pure-controls">
      <input type="submit" class="pure-button pure-button-good" />
  {{ Form::close() }}
@stop
