@extends('layouts.master')

@section('title', 'Profile - '.$title)

@section('content')

<h1>{{$user}}</h1>

<img src="{{$user->profile_photo}}" alt="">

@stop