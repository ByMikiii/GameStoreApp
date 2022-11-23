@extends('layouts.master')

@section('title', $title)

@section('content')

<section>
@foreach ($users as $user)
   <div id="user" class="flex">
   <span>{{$user->id}}.</span>
   <a href="/user/{{$user->name}}">{{$user->name}}</a>
   <form action="" method="post" class="ml-20">
      <button>Add Friend</button>
   </form>
   </div>
@endforeach
</section>
@stop