@extends('layout')

@section('title')
User Management
@stop

@section('content')
  @include('error')
  <h2>User Management</h2>
  <p>
    <a href="{{ URL::route('user.create') }}" class="pure-button pure-button-good">
      New User
    </a>
  </p>
  <table class="pure-table">
    <thead>
      <tr>
        <th>Name</th>
        <th>Classes</th>
        <th>Actions</th>
      </tr>
    </thead>
    @foreach ($users as $user)
      <tr>
        <td>
          {{ $user->first_name }} {{ $user->last_name }}
        </td>
        <td>
          {{ implode(",", $user->logins()->lists('class')) }}
        </td>
        <td>
          <a href="{{ URL::route('user.edit', $user->person_id) }}" class='pure-button pure-button-primary'>
            Edit
          </a>
          <a href="{{ URL::route('user.create_login', $user->person_id) }}" class="pure-button pure-button-secondary">
            New Login
          </a>
          <a href="{{ URL::route('user.add_doctor', $user->person_id) }}" class="pure-button pure-button-secondary">
            Manage Doctors
          </a>
        </td>
      </tr>
    @endforeach
  </table>
@stop
