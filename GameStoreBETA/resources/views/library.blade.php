@extends('layouts.master')

@section('title', 'Library')

@section('content')

<h1>My Games</h1>

@foreach ($games as $game)
   <p>{{$game->name}}</p> 
@endforeach

@if (!count($games))
    You do not have any games 😢
@endif

@stop