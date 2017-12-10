<?php

namespace App\Http\Controllers;

use App\Log;
use Auth;
use Illuminate\Http\Request;

class LogController extends Controller
{
    public function store(Request $request)
    {
      $validatedData = $request->validate([
          'dates' => 'max:255|required',
          'itinerary' => 'max:255|required',
          'description' => 'required',
          'miles' => 'digits_between:0,1000000'
      ]);

      $log = new Log();
      $log->user_id = Auth::id();
      $log->created_at = now();
      $log->dates = $request->dates;
      $log->itinerary = $request->itinerary;
      $log->description = $request->description;
      $log->miles = $request->miles;
      $log->save();

      return redirect()->to(route('editprofile').'#newitem')->with('message', "New log entry recorded succssesfully.");
    }

    public function delete($id)
    {
      Log::where('id', $id)->delete();
      return redirect()->back();
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      if(!Auth::check()){
        return redirect()->route('login');
      }
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */


    /**
     * Display the specified resource.
     *
     * @param  \App\Log  $log
     * @return \Illuminate\Http\Response
     */
    public function show(Log $log)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Log  $log
     * @return \Illuminate\Http\Response
     */
    public function edit(Log $log)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Log  $log
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Log $log)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Log  $log
     * @return \Illuminate\Http\Response
     */
    public function destroy(Log $log)
    {
      //
    }


}
