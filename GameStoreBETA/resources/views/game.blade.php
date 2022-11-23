@extends('layouts.master')

@section('title', $title)


@section('content')
<p>{{$game->name}} </p>   
<p>{{$game->publisher->name}} </p>   
<p>{{Carbon\Carbon::parse($game->release_date)->format('d/m/Y')}} </p>   
<p>{{$game->description}} </p>   
<p>{{$game->original_price}}$ </p>   
@stop