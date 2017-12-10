<?php

namespace App\Http\Controllers;

use App\Profile;
use App\User;
use App\Recommendation;
use App\Log;
use Auth;
use Excel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Pagination\LengthAwarePaginator;

class ListController extends Controller
{
  public function viewUserList($type, $status, $perPage = "10", $sortKey = "", $sortOrder = ""){
    $profiles = $this->getProfiles($type, $status);
    $profiles = $this->paginate($profiles, $perPage);
    $data = $this->getData($profiles, $type, $status, $sortKey, $sortOrder, $perPage);

    return view('users.userList', $data);
  }

  public function viewUserListSorted($type, $status, $sortKey, $sortOrder, $perPage = "10"){
    $profiles = $this->getProfiles($type, $status);
    if($sortOrder == 'desc'){
      $profiles = $this->sortProfilesDesc($profiles, $sortKey);
    } else if($sortOrder == 'asc'){
      $profiles = $this->sortProfilesAsc($profiles, $sortKey);
    }
    $profiles = $this->paginate($profiles, $perPage);
    $data = $this->getData($profiles, $type, $status, $sortKey, $sortOrder, $perPage);

    return view('users.userList', $data);
  }

  public function getData($profiles, $type, $status, $sortKey, $sortOrder, $perPage){
    $data = [
      'user' => User::where('id', Auth::id())->first(),
      'profiles' => $profiles,
      'status' => $status,
      'type' => $type,
      'sortKey' => $sortKey,
      'sortOrder' => $sortOrder,
      'perPage' => $perPage,
    ];
    return $data;
  }

  public function paginate($profiles, $perPage){
    $profiles = collect($profiles);
    $currentPage = LengthAwarePaginator::resolveCurrentPage();
    $currentPageSearchResults = $profiles->slice(($currentPage - 1) * $perPage, $perPage)->all();

    return new LengthAwarePaginator($currentPageSearchResults, count($profiles), $perPage);
  }

  public function getProfiles($type, $status){
    if($status == 'active'){
      $users = User::where([['status', 'Active'], ['type', $type]])->get();
    } else if($status == 'inactive'){
      $users = User::where([['status', 'Inactive'], ['type', $type]])->get();
    }
    foreach ($users as $user) {
      $attributes = Profile::where('user_id', $user->id)->get();
      $details = [];
      foreach ($attributes as $attribute) {
        $details[$attribute->attribute] = $attribute->attribute_value;
      }
      $profiles[$user->id] = $details;
      $profiles[$user->id]['miles'] = Log::where('user_id', $user->id)->sum('miles');
      $profiles[$user->id]['recom'] = Recommendation::where('to_id', $user->id)->count('recommendation');
      $profiles[$user->id]['username'] = $user->username;
      $profiles[$user->id]['name'] = $user->name;
    }
    return $profiles;
  }

  public function sortProfilesDesc($profiles, $key){
    uasort($profiles, function($a, $b) use($key){
      if (!isset($b[$key]) && isset($a[$key])) return -1;
      if (isset($b[$key]) && !isset($a[$key])) return 1;
      if (!isset($b[$key]) && !isset($a[$key])) return 0;
      if ($b[$key]>$a[$key]) return 1;
    });
    return $profiles;
  }

  public function sortProfilesAsc($profiles, $key){
    uasort($profiles, function($a, $b) use($key){
      if (!isset($b[$key]) && isset($a[$key])) return -1;
      if (isset($b[$key]) && !isset($a[$key])) return 1;
      if (!isset($b[$key]) && !isset($a[$key])) return 0;
      if ($b[$key]<$a[$key]) return 1;
    });
    return $profiles;
  }

  public function export($type, $status){
    $profiles = $this->getProfiles($type, $status);

    if($type == 'crew'){
      $export = $this->getCrewList($profiles);
    } else if($type == 'boat'){
      $export = $this->getBoatList($profiles);
    }
    $range = 'A1:H'.count($export).'';
    $fileName = $status.'_'.$type;
    Excel::create($fileName, function($excel) use ($export, $range) {
        $excel->sheet('Sheet1', function($sheet) use ($export, $range) {
            $sheet->fromArray($export, null, 'A1', false, false);
            $sheet->row(1, function($row) {
                $row->setBackground('#E6E6E6');
            });
            $sheet->setBorder($range, 'thin');
            $sheet->cells($range, function($cells) {
              $cells->setAlignment('center');
            });
        });
    })->export('xls');
  }

  public function getCrewList($profiles){
    $export[] = ['ID', 'USERNAME', 'NAME', 'AGE', 'LOCATION', 'QUALIFICATION', 'MILES LOGGED', 'RECOM No'];
    foreach ($profiles as $id => $profile) {
      $export[] = [$id, $profile['username'], $profile['name'], $profile['age'],
                    $profile['location'],$profile['qualification'], $profile['miles'], $profile['recom']];
    }
    return $export;
  }

  public function getBoatList($profiles){
    $export[] = ['ID', 'BOAT NAME', 'BOAT TYPE', 'MODEL', 'LOCATION', 'SAILING TYPE', 'CREW SIZE', 'CONTACT PERSON'];
    foreach ($profiles as $id => $profile) {
      $export[] = [$id, $profile['username'], $profile['boat_type'], $profile['model'],
                    $profile['location'],$profile['sailing_type'], $profile['crew_size'], $profile['contact_person']];
    }
    return $export;
  }

}
