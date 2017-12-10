<?php

namespace App\Http\Controllers;

use App\Profile;
use App\User;
use App\Recommendation;
use App\Message;
use Auth;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function index($type="", $msgId = ""){
      $user = User::where('id', Auth::id())->first();
      if($type=='received' && !empty($msgId)){
        Message::where('id', $msgId)->update(['unread' => 0]);
      }
      $msgRcvd = Message::select('messages.*', 'users.username')->
                    leftJoin('users', 'messages.from_id', '=', 'users.id')->
                    where([['messages.to_id', Auth::id()],['show_rcvr', '1']])->
                    orderBy('created_at', 'desc')->paginate(10, ['*'], 'rp')->fragment('received');
      $msgSent = Message::select('messages.*', 'users.username')->
                    leftJoin('users', 'messages.to_id', '=', 'users.id')->
                    where([['messages.from_id', Auth::id()],['show_sndr', '1']])->
                    orderBy('created_at', 'desc')->paginate(10, ['*'], 'sp')->fragment('sent');
      $unreadNo = $this->getUnreadNo();
      $data = [
        'user' => $user,
        'openMsgId' => $msgId,
        'msgRcvd' => $msgRcvd,
        'msgSent' => $msgSent,
        'unreadNo' => $unreadNo,
        'type' => $type
      ];
      return view('messaging.messages', $data);
    }

    public function getUnreadNo(){
      return Message::where([['to_id', Auth::id()], ['unread', '1'], ['show_rcvr', '1']])->count('message');
    }

    public function markAsRead($id){
      Message::where([['id', $id] ,['to_id', Auth::id()]])->update(['unread' => 0]);
      $unreadNo = $this->getUnreadNo();
      return $unreadNo;
    }

    public function hideMsg($type, $msgId){
      if($type == 'received'){
        Message::where('id', $msgId)->update(['show_rcvr' => 0]);
      } else if($type == 'sent'){
        Message::where('id', $msgId)->update(['show_sndr' => 0]);
      }
      return redirect()->back();
    }

    public function store(Request $request)
    {
      if(!isset($request->to)){
          $request->validate([
              'subject' => 'max:255',
              'message' => 'required',
          ]);
          $message = New Message();
          $message->created_at = now();
          $message->from_id = Auth::id();
          $message->to_id = $request->id;
          $message->subject = $request->subject;
          $message->message = $request->message;
          $message->unread = true;
          $message->show_sndr = true;
          $message->show_rcvr = true;
          $message->save();
          return redirect()->back()->with('message', "Message sent succssesfully.");
      } else if(isset($request->to)){
          $this->messageToAdmin($request);
          return redirect()->back()->with('message', "Request sent succssesfully.");
      }
    }

    public function messageToAdmin(Request $request){
      $request->validate([
          'message' => 'required',
      ]);
      $message = New Message();
      $message->created_at = now();
      $message->from_id = Auth::id();
      $message->to_id = '1';
      $message->subject = 'REQUEST TO REMOVE recommendation ID:'.$request->id;
      $message->message = $request->message;
      $message->unread = true;
      $message->show_sndr = true;
      $message->show_rcvr = true;
      $message->save();
    }

    public function show($id){
      $data = [
        'user' => User::where('id', $id)->first(),
      ];
      return view('messaging.sendMsg', $data);
    }

    public function reply($id, $backTo = ""){
      $data = [
        'user' => User::where('id', $id)->first(),
        'backTo' => $backTo
      ];
      return view('messaging.sendMsg', $data);
    }

    public function recomDeleteRequest($id){
      $recom = Recommendation::select('recommendations.*', 'users.username')->
                  leftJoin('users', 'recommendations.from_id', '=', 'users.id')->
                  where('recommendations.id', $id)->first();
      $data = [
        'user' => User::where('id', Auth::id())->first(),
        'recom' => $recom,
      ];

      return view('messaging.removeRecom', $data);
    }

}
