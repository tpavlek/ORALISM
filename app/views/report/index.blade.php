@extends('layout')

@section('title')
Report Generation
@stop

@section('content')
  @include('error')
  {{ Form::open(array('route' => 'report.generate', 
                      'class' => 'pure-form pure-form-aligned')) }}
  
    <div class="pure-control-group">
      {{ Form::label('diagnosis') }}
      {{ Form::select('diagnosis', $diagnoses) }}
    </div>

    <div class="pure-control-group">
      {{ Form::label('start_date') }}
      {{ Form::input('date', 'start_date') }}
    </div>

    <div class="pure-control-group">
      {{ Form::label('end_date') }}
      {{ Form::input('date', 'end_date') }}
    </div>

    <div class="pure-controls">
      <input type="submit" class="pure-button pure-button-good" value="Generate" />
    </div>
  {{ Form::close() }}

  <script>
    $(document).ready(function() {
      $('select').select2({ width: "400px" });
    });
  </script>
@stop
