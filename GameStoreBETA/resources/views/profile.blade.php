@extends('layouts.master')

@section('title', $title)

@section('content')

<h1>{{$user}}</h1>

<img src="{{$user->profile_photo}}" alt="">

@stop