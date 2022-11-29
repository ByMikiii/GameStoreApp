@extends('layouts.master')

@section('title', 'Library')

@section('content')

<h1>My Games</h1>

@foreach ($owned_games->games as $game)
    {{$game->name}}
@endforeach

@stop