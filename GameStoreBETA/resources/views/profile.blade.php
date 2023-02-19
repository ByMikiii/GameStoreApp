@extends('layouts.master')

@section('title', $title)

@section('content')

<div class="flex mx-auto w-72 mt-10 mb-6">
<img src="{{$user->profile_photo}}" alt="User Profile Photo" class="rounded-full w-32">

<div>
<h1 class="text-left text-4xl heading">{{$user->name}}</h1>
<?php if($user->name == Auth::user()?->name):?>
<button class="mybutton bg-yellow-400 text-black">
            Edit Profile
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
    <h2 class="text-2xl heading mb-4">Owned Games</h2>

    </div>
    
    <div class="w-1/2 p-4 mr-auto"> 
    <h2 class="text-2xl heading mb-4">Reviews</h2>
     <reviews :auth="{{Auth::user()}}" :game="0" :reviews="{{$reviews}}" :owngame="0"></reviews>
    </div> 
    
</div>


@stop