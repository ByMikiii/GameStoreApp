@extends('layouts.master')

@section('title', $title)

@section('content')


<ul id="community-list" class="grid mx-12 my-6 grid-cols-3 gap-8">
@foreach ($users as $user)
   <li class="item border rounded-lg p-2">

   <a class="flex mb-2" href="/user/{{$user->name}}">
   <img src="{{$user->profile_photo}}" alt="Profile photo" class="rounded-full">
   <span class="ml-2 my-auto text-lg">{{$user->name}}</span>
   </a>

   <div class="flex mb-1">
      <a class="bg-blue-500 ml-auto mr-1 p-1 rounded-md" href="">View Profile</a>
      @if (Auth::check() && $user->id != Auth::id())
      <form action="" method="post">
        <Button class="bg-green-800 ml-2 mr-1 p-1 rounded-md">Add Friend</Button>
      </form>
      @endif
   </div>
   </li>
@endforeach
</ul>

@stop