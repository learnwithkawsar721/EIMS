<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\SessionSetUp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SessionSetUpController extends Controller
{
     /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('checkrole');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         //show resources/Admin/Setup/Session/index.blade.php
         return view('Admin.Setup.Session.index',[
            'all_Session'=>SessionSetUp::orderBy('id')->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //show resources/Admin/Setup/Session/create.blade.php
        return view('Admin.Setup.Session.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         // SessionSetup Validate Start
         $request->validate([
            'session_name'=>"required|unique:session_set_ups,session_name",
        ]);
        // SessionSetup Validate End

        // SessionSetup Insert Code Start
        SessionSetUp::insert($request->except('_token')+[
            'user_id'=>Auth::id(),
            'created_at'=>Carbon::now()
        ]);
        // SessionSetup Insert Code End

        return redirect(route('sessionsetup.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SessionSetUp  $sessionSetUp
     * @return \Illuminate\Http\Response
     */
    public function show(SessionSetUp $sessionSetUp)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SessionSetUp  $sessionSetUp
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //show resources/Admin/Setup/Session/edit.blade.php
        return view('Admin.Setup.Session.edit',[
            'session'=>SessionSetUp::where('id',$id)->first(),
        ]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SessionSetUp  $sessionSetUp
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
         // SessionSetup Validate Start
         $request->validate([
            'session_name'=>"required|unique:session_set_ups,session_name,$id",
        ]);
        // SessionSetup Validate End
         $sessionSetUp = SessionSetUp::where('id',$id)->first();

          // SessionSetUp update Code Start
         $sessionSetUp->update($request->except('_method','_token'));
          // SessionSetUp update Code End

         return redirect(route('sessionsetup.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SessionSetUp  $sessionSetUp
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $SubjectStup = SessionSetUp::where('id',$id)->first();
        $SubjectStup->delete();
        return back();
    }
}
