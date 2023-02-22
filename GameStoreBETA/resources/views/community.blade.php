@extends('layouts.master')

@section('title', $title)

@section('content')

<?php if(Auth::check()){
App::setLocale(Auth::user()->locale);
}else App::setLocale('sk');
?>

<h1 class="heading text-4xl mb-8">{{__('community.community')}}</h1>
<ol id='community-list' class="user-list">
@foreach ($user as $user)
<section class='bg-scnd-color p-4 rounded-md h-32 hover:brightness-105'>
    <div class="h-full grid text-black">
        <a href="/user/{{$user->name}}" class="flex">
            <div class="rounded-full w-24">
            <img
                src="{{$user->profile_photo}}"
                alt="Profile Picture"
                class="rounded-full"
            />
            </div>
            <div class="mt-1 ml-3 w-full text-left">
            <p class="text-tx-color">{{ $user->name }} <?php if(Auth::user()?->id == $user->id): ?>
            <strong
                class="text-white mt-2"
            >
            (YOU)</strong
            >
            <?php endif; ?></p>
            <p class="text-gray-400 text-sm">{{$user->full_name}}</p>
            </div>
        </a>
        <?php
        if( Auth::user()?->id != $user->id):?>
        <addfriend :user="{{$user}}"
                   :isauth="{{Auth::check()}}"
                   :friends="<?php if (Auth::check()) {  echo $friends;} else { echo 0;}?>" 
                   :pending-friends-to="<?php if (Auth::check()) {  echo $pendingFriendsTo;} else { echo 0;}?>" 
                   :pending-friends-from="<?php if (Auth::check()) {  echo $pendingFriendsFrom;} else { echo 0;}?>" > </addfriend>
        <?php else: ?>
                <a class="mybutton bg-blue-400 w-32 ml-auto"  href="/profile">View Profile</a>
        <?php endif;?>
</section>
@endforeach
</ol>
@stop