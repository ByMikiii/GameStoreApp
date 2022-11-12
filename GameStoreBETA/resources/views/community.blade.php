@extends('layouts.master')

@section('title', 'Community')

@section('content')

<h1>Community</h1>

@foreach ($users as $user)
   <p>{{$user->id}} {{$user->name}}</p>
@endforeach

@stop