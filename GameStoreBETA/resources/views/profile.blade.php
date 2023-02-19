@extends('layouts.master')

@section('title', $title)

@section('content')

<div class="flex mx-auto w-2/3 mt-10 mb-6 p-2">

<div class="mx-auto">
    <img src="{{$user->profile_photo}}" alt="User Profile Photo" class="rounded-full w-32 mx-auto">
<h1 class="text-left text-4xl heading mx-auto mt-2 mb-3">{{$user->name}} <?php if(Auth::check()){if($user->name == Auth::user()->name){echo "<strong class='text-gray-200'>(TY) </strong>";}} ?></h1>
<?php if($user->name == Auth::user()?->name):?>
<button class="mybutton bg-yellow-400 text-black p-2">
            <a href="/profile/edit">Upraviť Profil</a>
        </button>
<?php elseif(Auth::check()): ?>
    <addfriend :user="{{$user}}"
               :friends="<?php if (Auth::check()) {  echo $friends;} else { echo 0;}?>" 
               :pending-friends-to="<?php if (Auth::check()) {  echo $pendingFriendsTo;} else { echo 0;}?>" 
               :pending-friends-from="<?php if (Auth::check()) {  echo $pendingFriendsFrom;} else { echo 0;}?>" >
    </addfriend>
<?php endif;?>
</div>
</div>
<div class="bg-scnd-color h-96 rounded-md flex text-center">

    <div class="w-1/2 p-4 ml-auto border-r border-bg-color">
    <h2 class="text-2xl heading mb-4">Vlastnené hry</h2>

    </div>
    
    <div class="w-1/2 p-4 mr-auto"> 
    <h2 class="text-2xl heading mb-4">Recenzie</h2>
     <reviews :auth="{{Auth::user()}}" :game="0" :reviews="{{$reviews}}" :owngame="0"></reviews>
    </div> 
    
</div>


@stop