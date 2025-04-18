@extends('layouts.master')

@section('title', 'Library')

@section('content')

<?php if(Auth::check()){
App::setLocale(Auth::user()->locale);
}else App::setLocale('sk');
?>


<h1 class="text-4xl heading text-center mb-4">{{__('library.library')}}</h1>

<?php if($games != '[]'): ?>
<library :games="{{$games}}" :currentgamee="{{$games[0]}}" :auth="{{Auth::user()}}" :lang="'{{Lang::locale()}}'"></library>
<?php else :?>
<h1 class="mt-72 text-5xl heading mx-auto"> {{__('library.nogames')}}</h1>
<?php endif; ?>
@stop