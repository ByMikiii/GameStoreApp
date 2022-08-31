
@extends('layouts.master')


@section('title', 'Page Title')

@section('content')

<h1>ByMikiii</h1>

<p>{{$title}}</p>

@foreach ($users as $user)
    <p>{{ $user->country->Code }}</p>
@endforeach

@stop
