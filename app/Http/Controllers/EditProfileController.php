<?php

namespace App\Http\Controllers;

use App\Profile;
use App\User;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class EditProfileController extends Controller
{
    public function index(){
      $profileController = New ProfileController();
      $data = $profileController->getData();
      return view('editProfile.editProfile', $data);
    }

    public function store(Request $request){
      $this->validateData($request);
      $this->storeSidebar($request);
      return redirect()->to(route('editprofile').'#saved')->with('status', 'Section updated successfuly.');
    }

    public function storeAbout(Request $request){
      $this->storeProfile('about', $request->about);
      return redirect()->route('editprofile')->with('success', 'Section updated successfuly.');
    }

    public function storeProfile($attribute, $attribute_value){
      if(empty($attribute_value)){
        Profile::where([['user_id', Auth::id()], ['attribute', $attribute]])->delete();
      } else if (!empty($attribute_value)){
        $profile = Profile::where([['user_id', Auth::id()], ['attribute', $attribute]])->first();
        if(empty($profile)){
          $profile = new Profile();
          $profile->user_id = Auth::id();
          $profile->attribute = $attribute;
          $profile->attribute_value = $attribute_value;
          $profile->save();
        } else if(!empty($profile)){
          $profile->attribute_value = $attribute_value;
          $profile->save();
        }
      }
    }

    public function validateData($request){
      $request->validate([
          'username' => 'required|max:255',
          'name' => 'max:255',
          'age' => 'max:255',
          'location' => 'max:255',
          'qualification' => 'max:255',
          'model' => 'max:255',
          'boat_type' => 'max:255',
          'sailing_type' => 'max:255',
          'crew_size' => 'max:255',
          'contact_person' => 'max:255',
      ]);
    }

    public function storeSidebar(Request $request){
      $user = User::where('id', Auth::id())->first();
      $user->username = $request->username;
      $user->status = $request->status;
      $user->name = isset($request->name)?$request->name:"";
      $user->save();
      if($request->form == 'crew'){
        $this->storeProfile('age', $request->age);
        $this->storeProfile('location', $request->location);
        $this->storeProfile('qualification', $request->qualification);
        $this->storeProfile('miles', $request->miles);
      } else if($request->form == 'boat'){
        $this->storeProfile('location', $request->location);
        $this->storeProfile('model', $request->model);
        $this->storeProfile('boat_type', $request->boat_type);
        $this->storeProfile('sailing_type', $request->sailing_type);
        $this->storeProfile('crew_size', $request->crew_size);
        $this->storeProfile('contact_person', $request->contact_person);
      }
    }

    public function storePhoto(Request $request){
      $request->validate([
          'photo' => 'required|image|max:1000',
      ]);
      $oldphoto = Profile::where([['user_id', Auth::id()], ['attribute', 'photo']])->first();
      if(!empty($oldphoto)){
        Storage::delete('public/photos/'.$oldphoto->attribute_value.'');
        Profile::where([['user_id', Auth::id()], ['attribute', 'photo']])->delete();
      }
      $path = $request->file('photo')->storeAs('public/photos', Auth::id());
      $photo = basename($path);
      $profile = new Profile();
      $profile->user_id = Auth::id();
      $profile->attribute = 'photo';
      $profile->attribute_value = $photo;
      $profile->save();

      return redirect()->route('editprofile');
    }

    public function destroy($deleteAcc){
      $profileController = New ProfileController();
      $data = $profileController->getData();
      $data['deleteAcc'] = $deleteAcc;
      return view('editProfile.editProfile', $data);
    }

}
