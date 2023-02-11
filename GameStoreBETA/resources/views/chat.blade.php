
@extends('layouts.master')


@section('title', $title)

@section('content')
<h1 class="text-4xl heading text-center mb-4">CHAT</h1>

<private-chat-page 
:friends="{{$friends}}" 
:auth="{{Auth::user()}}" 
:user="{{$user}}">
</private-chat-page>

@stop
