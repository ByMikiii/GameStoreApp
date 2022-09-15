
@extends('layouts.master')


@section('title', $title)

@section('content')

<h1>ByMikiii</h1>

@foreach ($games as $game)
<div>
    <a href="/game/{{$game->slug}}">{{$game->name}}</a>
</div>
@endforeach

@stop
