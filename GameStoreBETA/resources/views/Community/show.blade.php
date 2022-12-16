
<user :user-data="{{$u}}" :auth-user="<?php if (Auth::check()) {  echo Auth::user()->id;} else { echo 0;}?>"></user>

