@extends('layouts.master')

@section('title', $title)

@section('content')

<?php
if(Auth::check()){
App::setLocale(Auth::user()->locale);
}else App::setLocale('sk');
?>

<div class="flex mx-auto w-2/3 mt-10 mb-6 p-2">

<div class="mx-auto">
    <img src="{{$user->profile_photo}}" alt="User Profile Photo" class="border border-scnd-color rounded-full w-36 h-36 mx-auto">
<h1 class="text-left text-4xl heading mx-auto mt-2 mb-3">{{$user->name}} <?php if(Auth::check()){if($user->name == Auth::user()->name){echo "<strong class='text-gray-200'>(".__('profile.you').") </strong>";}} ?></h1>
<?php if($user->name == Auth::user()?->name):?>
<button class="mybutton bg-yellow-400 text-black p-2">
            <a href="/profile/edit">{{__('profile.editprofile')}}</a>
        </button>
<?php elseif(Auth::check()): ?>
    <addfriend :user="{{$user}}"
               :friends="<?php if (Auth::check()) {  echo $friends;} else { echo 0;}?>" 
               :pending-friends-to="<?php if (Auth::check()) {  echo $pendingFriendsTo;} else { echo 0;}?>" 
               :pending-friends-from="<?php if (Auth::check()) {  echo $pendingFriendsFrom;} else { echo 0;}?>" 
               :isauth="{{Auth::check()}}"
               :lang="'{{Lang::locale()}}'" >
    </addfriend>
<?php endif;?>
</div>
</div>
<div class="bg-bg-color mb-14 rounded-md flex text-center overflow-x-hidden overflow-y-scroll scrollbar-thin scrollbar-thumb-gray-800 scrollbar-track-bg-color">

    <div class="w-1/2 p-4 ml-auto">
    <h2 class="text-2xl heading mb-4">{{__('profile.ownedgames')}}</h2>
    <ol>
        @foreach ($games as $game)
        <li
            class="bg-scnd-color rounded-md mb-5 text-left relative flex hover:brightness-110"
        >
        <img
                            class="w-48 mr-3 rounded-l-md object-cover"
                            src="//localhost:3000/images/games/{{$game->slug}}/banner-1.jpg"
                            
                            alt="Game Banner"
                        />
        <a href="/game/{{$game->slug}}" class="text-2xl heading mt-auto mb-auto hover:text-tx-color hover:brightness-125">{{$game->name}}</a>
        <small class="text-gray-300 absolute bottom-0.5 right-2">{{
                    $game->pivot->created_at->format('d/m/Y')}}</small>
        </li>
        @endforeach
        </ol>
    </div>
    
    <div class="w-1/2 p-4 mr-auto"> 
    <h2 class="text-2xl heading mb-4">{{__('profile.reviews')}}</h2>
     <reviews :auth="{{Auth::user()}}" :game="0" :reviews="{{$reviews}}" :owngame="0"></reviews>
    </div> 
     
</div>


@stop