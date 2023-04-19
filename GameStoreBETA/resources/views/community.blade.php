@extends('layouts.master')

@section('title', $title)

@section('content')

<?php if(Auth::check()){
App::setLocale(Auth::user()->locale);
}else App::setLocale('sk');
?>

<h1 class="heading text-4xl mb-8">{{__('community.community')}}</h1>

        <community :users="{{$user}}" 
                    <?php if(Auth::check()){echo ":authid=\"".Auth::user()->id."\"";}?>
                   :friends="<?php if (Auth::check()) {  echo $friends;} else { echo 0;}?>"
                   :pendingfriendsto="<?php if (Auth::check()) {  echo $pendingFriendsTo;} else { echo 0;}?>"
                   :pendingfriendsfrom="<?php if (Auth::check()) {  echo $pendingFriendsFrom;} else { echo 0;}?>" >
        </community>

@stop