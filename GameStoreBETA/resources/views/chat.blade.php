
@extends('layouts.master')


@section('title', $title)

@section('content')
<private-chat-page :friends="{{$friends}}" :auth="{{Auth::user()}}" :user="{{$user}}"></private-chat-page>

@stop
{{-- 
  TODO: ADD TIMESTAMPS, STORE, PAYMANT...
  
  
  --}}