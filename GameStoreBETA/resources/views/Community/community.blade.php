@extends('layouts.master')

@section('title', $title)

@section('content')
<ol class="user-list">

@foreach ($user as $u)

      @include('community.show')

@endforeach

</ol>


@stop