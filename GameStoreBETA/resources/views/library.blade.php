@extends('layouts.master')

@section('title', 'Library')

@section('content')

<library :games="{{$games}}" :currentgamee="{{$games[0]}}"></library>

@stop