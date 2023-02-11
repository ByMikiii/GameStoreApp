@extends('layouts.master')

@section('title', 'Library')

@section('content')

<h1 class="text-4xl heading text-center mb-4">Knižnica</h1>
<?php ?>
<library :games="{{$games}}" :currentgamee="{{$games[0]}}"></library>

@stop