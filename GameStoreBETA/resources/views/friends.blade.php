@extends('layouts.master')

@section('title', $title)

@section('content')

<h1>Friends</h1>



{{-- <?php 
$i = 1;
?>
@foreach ($friends as $friend)
    <p>{{$i." ".$friend->name}}</p>
  <p>{{$friend}}</p>
   <?php $i++; ?> 
@endforeach --}}

@stop