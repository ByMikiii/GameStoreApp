
<user :user-data="{{$u}}" :auth-user="<?php if (Auth::check()) {  echo Auth::user()->id;} else { echo 0;}?>" :friends="<?php if (Auth::check()) {  echo $friends;} else { echo 0;}?>" :pending-friends-to="<?php if (Auth::check()) {  echo $pendingFriendsTo;} else { echo 0;}?>" :pending-friends-from="<?php if (Auth::check()) {  echo $pendingFriendsFrom;} else { echo 0;}?>"></user>
