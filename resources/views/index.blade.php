@extends('layouts.master')

@section('title', $title)

@section('content')

<?php
if(Auth::check()){
App::setLocale(Auth::user()->locale);
}else App::setLocale('sk');
?>


<h1 class="text-4xl heading text-center mb-6">{{__('index.market')}}</h1>

<gamefilter :genres="{{$genres}}" :newgames="{{$newGames}}" :salegames="{{$saleGames}}" :allgames="{{$games}}" :lang="'{{Lang::locale()}}'"></gamefilter>


@stop

