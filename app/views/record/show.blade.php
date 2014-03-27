@extends('layout')

@section('title')
View Record
@stop

@section('content')
<h2>Display Record</h2>

<table class="pure-table">
  <tr>
    <td>Doctor</td>
    <td>{{ $record->doctor->full_name }}
  </tr>
  <tr>
    <td>Patient</td>
    <td>{{ $record->patient->full_name }}</td>
  </tr>
  <tr>
    <td>Radiologist</td>
    <td>{{ $record->radiologist->full_name }}</td>
  </tr>
  <tr>
    <td>Test Type</td>
    <td>{{ $record->test_type }}</td>
  </tr>
  <tr>
    <td>Prescribing Date</td>
    <td>{{ $record->prescribing_date }}</td>
  </tr>
  <tr>
    <td>Test Date</td>
    <td>{{ $record->test_date }}</td>
  </tr>
  <tr>
    <td>Diagnosis</td>
    <td>{{ $record->diagnosis }}</td>
  </tr>
  <tr>
    <td>Description</td>
    <td>{{ $record->description }}</td>
  </tr>
</table>

<div class="pure-form">
  <legend>Images</legend>
  @foreach ($record->images as $image)
    <a href="{{ URL::route('record.show', array('id' => $record->record_id, 'img_size' => $img_size -1)) }}" class="pure-button pure-button-bad pure-button-large">
      -
    </a>

    <img src="data:image/jpeg;base64,{{ $image->getPic($img_size) }}" />
    <a href="{{ URL::route('record.show', array('id' => $record->record_id, 'img_size' => $img_size +1)) }}" class="pure-button pure-button-good pure-button-large">
      +
    </a><br>
  @endforeach
</div>

@stop
