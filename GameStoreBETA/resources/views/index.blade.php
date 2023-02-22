@extends('layouts.master')

@section('title', $title)

@section('content')

<?php
if(Auth::check()){
App::setLocale(Auth::user()->locale);
}else App::setLocale('sk');
?>

<h1 class="text-4xl heading text-center mb-6">{{__('index.market')}}</h1>

<h1 class="text-3xl heading text-left mb-4">{{__('index.news')}}</h1>
<ol id='games-list' class="h-full mb-16 mx-auto">
@foreach ($newGames as $newgame)
<a href="/game/{{$newgame->slug}}" class="w-80 h-48 bg-scnd-color rounded-md hover:text-tx-color hover:brightness-110 text-tx-color mb-14 mx-auto">
    <img class="object-cover rounded-t-md w-full h-2/3" src="{{ asset('/images/games/'.$newgame->slug.'/banner-1.jpg') }}" alt="Image of {{$newgame->name}}"> 
<div class="flex text-left h-1/3 p-3">
    <div class="w-56 truncate">
        <span class="font-semibold">{{$newgame->name}}</span>
        <p class="text-xs text-gray-400">{{$newgame->publisher->name}}</p>
    </div>
    <span class="ml-auto py-2.5 font-semibold">
        <?php
            if($newgame->original_price == 0){
                echo "Free";
            }else if($newgame->is_sale == 1){
                echo $newgame->sale_price."€";
            }else {echo $newgame->original_price."€";}

            ?>
    </span>
</div>
</a>
@endforeach
</ol>

<h1 class="text-3xl heading text-left mb-4">{{__('index.sales')}}</h1>
<ol id='games-list' class="h-full mb-16">
@foreach ($saleGames as $saleGame)
<a href="/game/{{$saleGame->slug}}" class="w-80 h-48 bg-scnd-color rounded-md hover:brightness-110 text-tx-color hover:text-tx-color mb-14 mx-auto">
    <img class="object-cover rounded-t-md w-full h-2/3" src="{{ asset('/images/games/'.$saleGame->slug.'/banner-1.jpg') }}" alt="Image of {{$saleGame->name}}"> 
<div class="flex text-left h-1/3 p-3">
    <div class="w-56 truncate">
        <span class="font-semibold">{{$saleGame->name}}</span>
        <p class="text-xs text-gray-400">{{$saleGame->publisher->name}}</p>
    </div>
    <span class="ml-auto py-2.5 font-semibold">
        <?php
            if($saleGame->original_price == 0){
                echo "Free";
            }else if($saleGame->is_sale == 1){
                echo $saleGame->sale_price."€";
            }else {echo $saleGame->original_price."€";}

            ?>
    </span>
</div>
</a>
@endforeach
</ol>


<h1 class="text-3xl heading text-left mb-4">{{__('index.allgames')}}</h1>
<ol id='games-list' class="h-full">
@foreach ($games as $game)
<a href="/game/{{$game->slug}}" class="w-80 h-48 bg-scnd-color rounded-md hover:text-tx-color hover:brightness-110 text-tx-color mb-14 mx-auto">
    <img class="object-cover rounded-t-md w-full h-2/3" src="{{ asset('/images/games/'.$game->slug.'/banner-1.jpg') }}" alt="Image of {{$game->name}}"> 
<div class="flex text-left h-1/3 p-3">
    <div class="w-56 truncate">
        <span class="font-semibold">{{$game->name}}</span>
        <p class="text-xs text-gray-400">{{$game->publisher->name}}</p>
    </div>
    <span class="ml-auto py-2.5 font-semibold">
        <?php
            if($game->original_price == 0){
                echo "Free";
            }else if($game->is_sale == 1){
                echo $game->sale_price."€";
            }else {echo $game->original_price."€";}

            ?>
    </span>
</div>
</a>
@endforeach
</ol>
@stop
