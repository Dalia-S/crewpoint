<?php

namespace App\Http\Controllers;

use App\User;
use App\Profile;
use App\Log;
use Auth;
use Illuminate\Http\Request;

class UserController extends Controller
{
  public function delete(){
    Profile::where('user_id', Auth::id())->delete();
    Log::where('user_id', Auth::id())->delete();
    User::where('id', Auth::id())->delete();
    Auth::logout();
    return redirect()->route('home');
  }

  public function index(){
    return 'working';
  }

  public function create(){

  }

  public function store(Request $request){

  }

  public function show(User $user){
      return $user;
  }

  public function edit(User $user){

  }

  public function update(Request $request, User $user){

  }

  public function destroy(User $user){

  }

}
