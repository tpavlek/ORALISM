@extends('layout')

@section('title')
Search Results
@stop

@section('content')
<h2>Search Results</h2>

<table class="pure-table">
  <tr>
    <td>Patient ID</td>
    @foreach ($records as $record)
      <td>{{ $record->patient_id }}
    @endforeach
  </tr>
  <tr>
    <td>Doctor ID</td>
    @foreach ($records as $record)
      <td>{{ $record->doctor_id }}
    @endforeach
  </tr>
  <tr>
    <td>Radiologist ID</td>
    @foreach ($records as $record)
      <td>{{ $record->radiologist_id }}
    @endforeach
  </tr>
  <tr>
    <td>Test Type</td>
    @foreach ($records as $record)
      <td>{{ $record->test_type }}
    @endforeach
  </tr>
  <tr>
    <td>Prescribing Date</td>
    @foreach ($records as $record)
      <td>{{ $record->prescribing_date }}
    @endforeach
  </tr>
  <tr>
    <td>Test Date</td>
    @foreach ($records as $record)
      <td>{{ $record->test_date }}
    @endforeach
  </tr>
  <tr>
    <td>Diagnosis</td>
    @foreach ($records as $record)
      <td>{{ $record->diagnosis }}
    @endforeach
  </tr>
  <tr>
    <td>Description</td>
    @foreach ($records as $record)
      <td>{{ $record->description }}
    @endforeach
  </tr>
</table>
@stop
