@extends('layouts.master')

@section('title', $title)


@section('content')
  <basket :basketitems="{{$basketitems}}" :totalprice="{{$totalprice}}"></basket>
  @stop