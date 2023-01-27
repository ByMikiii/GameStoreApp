@extends('layouts.master')

@section('title', $title)


@section('content')
<gamepage :game="{{$game}}"></gamepage>
@stop