@extends('layouts.master')

@section('title', $title)


@section('content')
    <p class="text-left text-4xl">{{ $game->name }}</p>
    <div class="flex">
        <img
            class="w-1/2"
            src="//localhost:3000/images/games/example.jpg"
            alt="Game Image"
        />
        <span class="">{{ $game->description }}</span>
    </div>

<?php if(Auth::check()): ?>
<gamepage :game="{{$game}}"></gamepage>
<?php endif;?>

<review></review>

@stop