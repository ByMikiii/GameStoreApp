<?php

namespace App\Http\Controllers;
use Auth;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\PagesController;
use Illuminate\Support\Facades\Auth as FacadesAuth;

class UserAvatarController extends Controller
{
    function index(Request $request){
        $newusername = $request->input('username');
        $newname = $request->input('fullname');
        $newemail = $request->input('email');
        $newaddress = $request->input('address');

        if($newusername != Auth::user()->name){
            $foundUsers = User::where('name', $newusername)->get();
            if($foundUsers != ""){
                Auth::user()->update(['name' => $newusername]);
            }
        }

        if($newname != Auth::user()->full_name){
            Auth::user()->update(['full_name' => $newname]);
        }

        if($newemail != Auth::user()->email){
            $foundUsers = User::where('email', $newemail)->get();
            if($foundUsers != ""){
                Auth::user()->update(['email' => $newemail]);
            }
        }

        if($newaddress != Auth::user()->address){
            Auth::user()->update(['address' => $newaddress]);
        }

        
        if($request->file('file') != ""){
        $request->file('file')->storeAs('/public/images', Auth::user()->id);

        Auth::user()->update(['profile_photo' => 'http://localhost:3000/storage/images/101']);
        }

        session()->flash('flash', __('edit.success'));
        return redirect()->action([PagesController::class, 'editprofile']);


        
    }

}
