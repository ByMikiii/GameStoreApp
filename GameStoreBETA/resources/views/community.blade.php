@extends('layouts.master')

@section('title', $title)

@section('content')
<ol id='community-list' class="user-list">
@foreach ($user as $u)
<section id='user' class='bg-gray-800 p-4'>
<community 
      :user-data="{{$u}}" 
      :auth-user="<?php if (Auth::check()) {  echo Auth::user()->id;} else { echo 0;}?>" 
      :friends="<?php if (Auth::check()) {  echo $friends;} else { echo 0;}?>" 
      :pending-friends-to="<?php if (Auth::check()) {  echo $pendingFriendsTo;} else { echo 0;}?>" 
      :pending-friends-from="<?php if (Auth::check()) {  echo $pendingFriendsFrom;} else { echo 0;}?>">

</community>
</section>
@endforeach
</ol>
@stop