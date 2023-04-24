@extends('layouts.master')

@section('title', $title)


@section('content')

<?php if(Auth::check()){
App::setLocale(Auth::user()->locale);
}else App::setLocale('sk');
?>

    <p class="text-left text-4xl heading mb-5">{{ $game->name }}</p>
    <div class="flex h-96">

            <?php if ($game->is_sale == 1): ?>
            <p class="ml-2 mt-2 absolute heading text-lg w-14 h-14 py-3 rounded-2xl bg-scnd-color border-bg-color">-{{floor(($game->original_price - $game->current_price) / $game->original_price * 100)}}%</p>
            <?php endif; ?>

            <img
                class="w-auto rounded-md mx-auto"
                src="//localhost:3000/images/games/{{ $game->slug }}/banner-1.jpg"
                alt="Game Image"
            />

<div class="px-8 w-4/6 h-full relative flex flex-col">
    <div class="overflow-y-scroll scrollbar-thin scrollbar-thumb-gray-800 scrollbar-track-bg-color">
    <div class="text-left mb-4">{{__('game.publisher')}}: <span class="ml-2 font-extrabold">{{$game->publisher->name}}</span></div>
    <div class="text-left mb-4">{{__('game.releasedate')}}: <span class="ml-2 font-extrabold">{{$game->release_date->format('d. m. Y')}}</span></div>
    <div class=" text-justify">{{ $game->description }}</div>
</div>
   <div class="flex-1 flex mt-2">

    <?php if($owngame == 0): ?>
            <span class="line-through heading text-slate-400 text-2xl mt-auto ml-auto">            
            <?php
            if($game->is_sale == 1){
                echo $game->original_price."€";
            }
            ?>
        </span>
        <span class="heading text-2xl ml-2 mt-auto">
            <?php
            if($game->current_price <= 0){
                echo "Free";
            }else {echo $game->current_price."€";}

            ?>
        </span>
<?php else: ?>
<div class="ml-auto"></div>
<?php endif; ?>

    <?php if(Auth::check()): ?>
<gamepage :game="{{$game}}" :owngame="{{$owngame}}" :lang="'{{Lang::locale()}}'" ></gamepage>
    <?php else: ?>
<div class="mr-auto"></div>
    <?php endif; ?>
</div>
</div>
</div>

<div id="genres" class="text-left w-auto max-w-2xl mt-2 h-16"> 
    
    @foreach ($game->game_genre as $genre)
    <small class="bg-gray-600 text-gray-100 py-0.5 px-1 rounded-sm opacity-70 relative mr-2">#{{$genre->genre_name}} </small>
    @endforeach
    
</div>
<reviews :auth="{{Auth::user()}}" :game="{{$game}}" :reviews="{{$reviews}}" :owngame="{{$owngame}}" :lang="'{{Lang::locale()}}'" ></reviews>




@stop