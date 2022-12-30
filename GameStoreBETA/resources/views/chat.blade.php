
@extends('layouts.master')


@section('title', $title)

@section('content')

<section class='border w-3/5 rounded-md mx-auto'>
  <div class='w-full text-2xl text-center border-b p-2 pb-3'>
  <a href='/user/{{$username}}'>{{$username}}</a>
  </div>
  <ol class=''>

    @foreach ($messages as $m)
        <message :message='{{$m}}' :auth-user='{{Auth::user()->id}}' ></message>
    @endforeach
  </ol>
</section>
@stop
