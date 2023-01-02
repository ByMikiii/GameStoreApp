
@extends('layouts.master')


@section('title', $title)

@section('content')
<private-chat-page :friends="{{$friends}}" :auth="{{Auth::user()}}" :user="{{$user[0]}}"></private-chat-page>
@stop
