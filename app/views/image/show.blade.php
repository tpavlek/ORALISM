@extends('layout')

@section('title')
View Image
@stop

@section('content')
@include('error')
@if(sizeof($errors) == 0)
<a href="{{ URL::route('image.show', array('record_id' => $record_id, 'image_id' => $image_id, 'img_size' => $img_size -1)) }}" class="pure-button pure-button-bad pure-button-large">
  -
</a>
<img src="data:image/jpeg;base64,{{ $image->getPic($img_size) }}" />
<a href="{{ URL::route('image.show', array('record_id' => $record_id, 'image_id' => $image_id, 'img_size' => $img_size +1)) }}" class="pure-button pure-button-good pure-button-large">
  +
</a>
@endif
@stop
