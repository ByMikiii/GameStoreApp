
@extends('layouts.master')


@section('title', $title)

@section('content')
@foreach ($games as $game)
<div>
    <a class="" href="/game/{{$game->slug}}">{{$game->name}}</a>
</div>
@endforeach
@stop
