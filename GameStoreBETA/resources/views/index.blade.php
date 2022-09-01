
@extends('layouts.master')


@section('title', 'Page Title')

@section('content')

<h1>ByMikiii</h1>

<p>{{$title}}</p>

@foreach ($users as $user)
<div>
    <h1>{{ $user->username }}</h1>
    <h2>{{ $user->full_name }}</h2>
    <h2>{{ $user->email }}</h2>
    <p>{{$user->country->Name.'(population: '.$user->country->Population .')'}}</p>
    <p>------------------------------------</p>
</div>
@endforeach

@stop
