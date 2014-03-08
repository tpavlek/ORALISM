@extends('layout')

@section('title')
Edit User
@stop

@section('content')
@include('error')
{{ Form::model($person, array('route' => 'user.update', 'class' => 'pure-form pure-form-aligned')) }}
  <legend>Edit Person: {{ $person->first_name }} {{ $person->last_name }}</legend>
  <div class="pure-control-group">
    {{ Form::label('first_name') }}
    {{ Form::text('first_name') }}
  </div>

  <div class="pure-control-group">
    {{ Form::label('last_name') }}
    {{ Form::text('last_name') }}
  </div>

  <div class="pure-control-group">
    {{ Form::label('address') }}
    {{ Form::text('address') }}
  </div>
  
  <div class="pure-control-group">
    {{ Form::label('email') }}
    {{ Form::input('email', 'email') }}
  </div>
  
  <div class="pure-control-group">
    {{ Form::label('phone') }}
    {{ Form::input('tel', 'phone') }}
  </div>

  <div class="pure-controls">
    <input type="submit" value="Save" class="pure-button pure-button-good" />
  </div>
{{ Form::close() }}

@foreach ($logins as $login)
  
  {{ Form::model($login, array('route' => 'user.updateLogin', 'class' => 'pure-form pure-form-aligned')) }}
    <legend>Edit Login: {{ $login->user_name }}</legend>
    <div class="pure-control-group">
      {{ Form::label('user_name') }}
      {{ Form::text('user_name') }}
    </div>

    <div class="pure-control-group">
      {{ Form::label('password', "New Password") }}
      {{ Form::password('password') }}
    </div>

    @if (Auth::user()->class == 'a')
      <div class="pure-control-group">
        {{ Form::label('class') }}
        {{ Form::select('class', User::classes()) }}
      </div>
    @endif
    <div class="pure-controls">
      <input type="submit" value="Save" class="pure-button pure-button-good" />
    </div>
  {{ Form::close() }}

@endforeach
@stop
