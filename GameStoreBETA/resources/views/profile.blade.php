@extends('layouts.master')

@section('title', $title)

@section('content')

<img src="{{$user->profile_photo}}" alt="User Profile Photo" class="mx-auto rounded-full w-48 outline outline-2 outline-white">

<h1 class="text-4xl">{{$user->name}}</h1>
<?php if($user->name == Auth::user()->name):?>
<button class="button is-success w-24">
            Edit Profile
        </button>
<?php else: ?>
    <addfriend :user="{{$user}}"
               :friends="<?php if (Auth::check()) {  echo $friends;} else { echo 0;}?>" 
               :pending-friends-to="<?php if (Auth::check()) {  echo $pendingFriendsTo;} else { echo 0;}?>" 
               :pending-friends-from="<?php if (Auth::check()) {  echo $pendingFriendsFrom;} else { echo 0;}?>" >
    </addfriend>
<?php endif;?>


<h2 class="text-2xl text-left">Owned Games</h2>

<h2 class="text-2xl text-left">Reviews</h2>



@stop