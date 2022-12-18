@extends('layouts.master')

@section('title', $title)

@section('content')
<ol id='community-list' class="user-list">
@foreach ($user as $u)
<section id='user' class='bg-gray-800 p-4'>
      @include('community.users')
</section>
@endforeach
</ol>
@stop