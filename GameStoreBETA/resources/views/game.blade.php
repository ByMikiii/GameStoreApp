@extends('layouts.master')

@section('title', 'nehehe')

@section('content')

@foreach ($games as $game)
<p>{{$game->name}} </p>   
<p>{{$game->publisher->name}} </p>   
<p>{{Carbon\Carbon::parse($game->release_date)->format('d/m/Y')}} </p>   
<p>{{$game->description}} </p>   
<p>{{$game->original_price}}$ </p>   


 
@endforeach
