<?php

namespace App\Http\Controllers;

use App\Profile;
use App\User;
use App\Recommendation;
use App\Message;
use App\Log;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class ProfileController extends Controller
{
    public function index(){
      $data = $this->getData();
      $data['myprofile'] = true;
      return view('users.profile', $data);
    }

    public function show($id, $back=""){
      $user = User::where('id', $id)->first();
      if($user->type == 'crew'){
        $data = $this->getCrewProfile($user);
      } else if ($user->type == 'boat'){
        $data = $this->getBoatProfile($user);
      }
      $data['myprofile'] = false;
      return view('users.profile', $data);
    }

    public function getData(){
      $user = Auth::user();
      if($user->type == 'crew'){
        $data = $this->getCrewProfile($user);
      } else if ($user->type == 'boat'){
        $data = $this->getBoatProfile($user);
      }
      return $data;
    }

    public function getCrewProfile($user){
      $data = [
        'user' => $user,
        'profile' => $this->getProfile($user),
        'milesTotal' => $this->getLoggedMiles($user),
        'logItems' => $this->getLogItems($user),
        'recommendations' => $this->getRecommendations($user),
        'msg' => $this->getNewMessages($user)
      ];
      return $data;
    }

    public function getBoatProfile($user){
      $data = [
        'user' => $user,
        'profile' => $this->getProfile($user),
        'logItems' => $this->getLogItems($user),
        'recommendations' => $this->getRecommendations($user),
        'msg' => $this->getNewMessages($user)
      ];
      return $data;
    }

    public function getProfile($user){
      $attributes = Profile::where('user_id', $user->id)->get();
      foreach ($attributes as $attribute) {
        $profile[$attribute->attribute] = $attribute->attribute_value;
      }
      return isset($profile)?$profile:'';
    }

    public function getNewMessages($user){
      return Message::where([['to_id', $user->id], ['unread', '1'], ['show_rcvr', '1']])->count('message');
    }

    public function getLogItems($user){
      return Log::where('user_id', $user->id)->orderBy('created_at', 'desc')->paginate(2, ['*'], 'log')->fragment('log');
    }

    public function getLoggedMiles($user){
      return Log::where('user_id', $user->id)->sum('miles');
    }

    public function getRecommendations($user){
      return Recommendation::select('recommendations.*', 'users.username')->
                    leftJoin('users', 'recommendations.from_id', '=', 'users.id')->
                    where('recommendations.to_id', $user->id)->orderBy('created_at', 'desc')->paginate(2, ['*'], 'recom')->fragment('recommendations');
    }

}
