@extends('layouts.master')

@section('title', 'Library')

@section('content')

<h1 class="text-4xl heading text-center mb-4">Knižnica</h1>

<?php if($games != '[]'): ?>
<library :games="{{$games}}" :currentgamee="{{$games[0]}} ?>" :auth="{{Auth::user()}}"></library>
<?php else :?>
<h1 class="mt-72 text-5xl heading mx-auto"> Nevlastnine žiadne hry. 🥲</h1>
<?php endif; ?>
@stop