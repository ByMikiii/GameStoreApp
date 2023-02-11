@extends('layouts.master')

@section('title', $title)

@section('content')

<div class="flex mx-auto w-72">
<img src="{{$user->profile_photo}}" alt="User Profile Photo" class="rounded-full w-32">

<div>
<h1 class="text-left text-4xl heading">{{$user->name}}</h1>
<?php if($user->name == Auth::user()->name):?>
<button class="mybutton bg-green-500">
            Edit Profile
        </button>
<?php else: ?>
    <addfriend :user="{{$user}}"
               :friends="<?php if (Auth::check()) {  echo $friends;} else { echo 0;}?>" 
               :pending-friends-to="<?php if (Auth::check()) {  echo $pendingFriendsTo;} else { echo 0;}?>" 
               :pending-friends-from="<?php if (Auth::check()) {  echo $pendingFriendsFrom;} else { echo 0;}?>" >
    </addfriend>
<?php endif;?>
</div>
</div>

<h2 class="text-2xl text-left heading">Owned Games</h2>

<h2 class="text-2xl text-left heading">Reviews</h2>


@stop