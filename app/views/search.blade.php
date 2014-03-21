@extends('layout')

@section('title')
Search
@stop

@section('content')
  @include('error')
  {{ Form::open(array('route' => 'search.results', 'class' => 'pure-form pure-form-aligned')) }}
  <div class="pure-control-group">
    {{ Form::label('search') }}
    {{ Form::text('search') }}<br>
    Start Date:
    <input type="date" name="startDate"/><br>
    End Date:
    <input type="date" name="endDate"/>
  </div>

  <div class="pure-controls">
    <input type='submit' value='Search' class="pure-button pure-button-good" />
  </div>
  {{ Form::close() }}
@stop
