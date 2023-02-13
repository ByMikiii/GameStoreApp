@extends('layouts.master')

@section('title', $title)


@section('content')

    <p class="text-left text-4xl heading mb-5">{{ $game->name }}</p>
    <div class="flex">
        <img
            class="w-1/2 h-96 rounded-md mx-auto"

            src="//localhost:3000/images/games/{{ $game->slug }}/banner-1.jpg"
            alt="Game Image"
        />
<div class="px-4">
    <span class="">{{ $game->description }}</span>
    <br>
    <?php if(Auth::check()): ?>
<gamepage :game="{{$game}}" class="relative mb-0 mt-auto"></gamepage>
<?php endif;?>
</div>

</div>


<reviews :authid="{{Auth::user()?->id}}" :game="{{$game}}" :reviews="{{$reviews}}"></reviews>




@stop