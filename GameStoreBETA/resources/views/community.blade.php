@extends('layouts.master')

@section('title', $title)

@section('content')
<ol id='community-list' class="user-list">
@foreach ($user as $u)
<section id='user' class='bg-gray-800 p-4'>
    <div class="h-20 grid text-black">
        <a href="/user/{{$u->name}}" class="flex">
            <img
                src="{{$u->profile_photo}}"
                alt="Profile Picture"
                class="rounded-full"
            />
            <p class="text-red-500 mt-2">{{ $u->name }}</p>

            <?php if(Auth::user()->id == $u->id): ?>
            <strong
                class="text-white mt-2"
            >
                &nbsp;&nbsp;(YOU)</strong
            >
            <?php endif; ?>
        </a>
        <addfriend :user="{{$u}}"
                   :friends="<?php if (Auth::check()) {  echo $friends;} else { echo 0;}?>" 
                   :pending-friends-to="<?php if (Auth::check()) {  echo $pendingFriendsTo;} else { echo 0;}?>" 
                   :pending-friends-from="<?php if (Auth::check()) {  echo $pendingFriendsFrom;} else { echo 0;}?>" > </addfriend>
</section>
@endforeach
</ol>
@stop