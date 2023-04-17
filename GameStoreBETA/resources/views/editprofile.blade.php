@extends('layouts.master')

@section('title', $title)

@section('content')

<h1 class="text-4xl heading text-center mb-4">Úprava profilu</h1>

<div id="private-chat" class="bg-scnd-color w-2/3 relative rounded-md mx-auto p-4 overflow-x-hidden overflow-y-scroll scrollbar-thin scrollbar-thumb-gray-800 scrollbar-track-bg-color">
<div class="mx-auto mt-6">
    <img src="{{$user->profile_photo}}" alt="User Profile Photo" class="rounded-full w-32 mx-auto">


<input class="mx-auto mt-4 block text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer dark:text-gray-400 focus:outline-none dark:bg-bg-color dark:border-gray-600 dark:placeholder-gray-400" id="file_input" type="file" accept="image/png, image/jpeg, image/jpg, image/webp">
</div>

<form action="" method="post" class="mt-6">

<div class="mt-20 flex">
    <input class="focus:outline-none ml-auto mr-16 focus:border-b-yellow-300 bg-scnd-color border-b text-2xl" spellcheck="false" id="text" type="text" value="{{Auth::user()->name}}" placeholder="Username" class="form-control" name="username" required>

    <input class="focus:outline-none mr-auto ml-16 focus:border-b-yellow-300 bg-scnd-color border-b text-2xl" spellcheck="false" id="name" type="name" value="{{Auth::user()->fullname}}" placeholder="Full Name" class="form-control" name="fullname" required>
</div>

<div class="mt-16 flex">
    <input class="focus:outline-none ml-auto mr-16 focus:border-b-yellow-300 bg-scnd-color border-b text-2xl" spellcheck="false" id="email" type="email" value="{{Auth::user()->email}}" placeholder="Email" class="form-control" name="email" required>

    <input class="focus:outline-none mr-auto ml-16 focus:border-b-yellow-300 bg-scnd-color border-b text-2xl" spellcheck="false" id="text" type="text" value="{{Auth::user()->address}}" placeholder="Address" class="form-control" name="address" required>
</div>

<div class="mt-24 flex">

  <input class="focus:outline-none ml-auto mr-16 focus:border-b-yellow-300 bg-scnd-color border-b text-2xl" spellcheck="false" id="newpassword" type="password" placeholder="New Password" class="form-control" name="newpassword">

  <input class="focus:outline-none mr-auto ml-16 focus:border-b-yellow-300 bg-scnd-color border-b text-2xl" spellcheck="false" id="newpasswordrepeat" type="password" placeholder="Repeat New Password" class="form-control" name="newpasswordrepeat">
  
</div>

<div class="mt-16 flex">
  <input class="focus:outline-none mx-auto focus:border-b-yellow-300 bg-scnd-color border-b text-2xl" spellcheck="false" id="oldpassword" type="password" placeholder="Old password" class="form-control" name="oldpassword">
</div>

<div class="flex mt-20 mx-auto text-center">
  <button type="submit" class="mybutton bg-blue-400 text-black p-2 px-4 text-lg hover:brightness-125 ml-auto mr-5"><a href="http://localhost:3000/password/email">Change password</a></button>
  <button type="submit" class="mybutton bg-tx-color text-black p-2 px-4 text-lg hover:brightness-125 mr-auto">Save</button>
</div>

</form>

</div>
@stop