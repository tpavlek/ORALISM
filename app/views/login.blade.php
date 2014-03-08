@extends('layout')

@section('title')
Login
@stop

@section('content')
  @include('error')
  {{ Form::open(array('route' => 'login.verify', 'class' => 'pure-form pure-form-aligned')) }}     
  <div class="pure-control-group">
    {{ Form::label('userName') }}
    {{ Form::text('userName') }}
  </div>
  <div class="pure-control-group">
    {{ Form::label('password') }}
    {{ Form::password('password') }}
  </div>

  <div class="pure-controls">
    <input type='submit' value='Login' class="pure-button pure-button-good" />
  </div>
  {{ Form::close() }}
@stop
