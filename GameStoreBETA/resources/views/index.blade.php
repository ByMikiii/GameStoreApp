
@extends('layouts.master')


@section('title', $title)

@section('content')

<section class="w-3/5 mx-auto">
<h1 class="text-2xl">ALL GAMES</h1>
<ol id='games-list' class="">
@foreach ($games as $game)
<a href="/game/{{$game->slug}}" class="">
    <img src="{{ asset('/images/games/example.jpg') }}" alt="{{$game->name}} image" class="">
    <span class="">{{$game->name}}</span>
</a>
@endforeach
</ol>
</section>
@stop
