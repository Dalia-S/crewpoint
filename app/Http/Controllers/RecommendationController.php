<?php

namespace App\Http\Controllers;

use App\User;
use App\Recommendation;
use App\Message;
use Auth;
use Illuminate\Http\Request;

class RecommendationController extends Controller
{
    public function show($id)
    {
      $data = [ 'user' => User::where('id', $id)->first() ];

      return view('messaging.recommend', $data);
    }

    public function store(Request $request)
    {
      $recom = New Recommendation();
      $recom->created_at = now();
      $recom->from_id = Auth::id();
      $recom->to_id = $request->id;
      $recom->recommendation = $request->recom;
      $recom->save();
      $this->sendAutoMessage($request);

      return redirect()->route('recommendation.show', $request->id)->with('message', "Recommendation submitted succssesfully.");
    }

    public function sendAutoMessage(Request $request){
      $message = New Message();
      $message->created_at = now();
      $message->from_id = Auth::id();
      $message->to_id = $request->id;
      $message->subject = 'RECOMMENDATION';
      $message->message = $request->recom;
      $message->unread = true;
      $message->show_sndr = true;
      $message->show_rcvr = true;

      $message->save();
    }



    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Recommendation  $recommendation
     * @return \Illuminate\Http\Response
     */
    public function edit(Recommendation $recommendation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Recommendation  $recommendation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Recommendation $recommendation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Recommendation  $recommendation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Recommendation $recommendation)
    {
        //
    }


}
