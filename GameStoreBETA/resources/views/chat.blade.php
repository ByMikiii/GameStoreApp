
@extends('layouts.master')


@section('title', $title)

<?php if(Auth::check()){
App::setLocale(Auth::user()->locale);
}else App::setLocale('sk');
?>

@section('content')
<h1 class="text-4xl heading text-center mb-4">CHAT</h1>
<private-chat-page 
:friends="{{$friends}}" 
:auth="{{Auth::user()}}" 
:user="{{$user}}"
:lang="'{{Lang::locale()}}'" >
</private-chat-page>
@stop
