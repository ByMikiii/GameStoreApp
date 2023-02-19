@extends('layouts.master')

@section('title', $title)


@section('content')

    <p class="text-left text-4xl heading mb-5">{{ $game->name }}</p>
    <div class="flex h-96">
        <img
            class="w-1/2 h-full rounded-md mx-auto"

            src="//localhost:3000/images/games/{{ $game->slug }}/banner-1.jpg"
            alt="Game Image"
        />
<div class="px-4 h-full relative flex flex-col">
    <div class="overflow-y-scroll scrollbar-thin scrollbar-thumb-gray-800 scrollbar-track-bg-color">{{ $game->description }}</div>

   <div class="flex-1 flex mt-2">

    <?php if($owngame == 0): ?>
        <span class="heading text-2xl ml-auto mt-auto">
            <?php
            if($game->original_price == 0){
                echo "Free";
            }else if($game->is_sale == 1){
                echo $game->sale_price."€";
            }else {echo $game->original_price."€";}

            ?>
        </span>
<?php else: ?>
<div class="ml-auto"></div>
<?php endif; ?>


    <?php if(Auth::check()): ?>
<gamepage :game="{{$game}}" :owngame="{{$owngame}}"></gamepage>
    <?php else: ?>
<div class="mr-auto"></div>
    <?php endif; ?>
</div>
</div>

</div>

<reviews :auth="{{Auth::user()}}" :game="{{$game}}" :reviews="{{$reviews}}" :owngame="{{$owngame}}"></reviews>




@stop