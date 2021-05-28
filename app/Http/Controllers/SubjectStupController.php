<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\SubjectStup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SubjectStupController extends Controller
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
        //show resources/Admin/Setup/Subject/index.blade.php
        return view('Admin.Setup.Subject.index',[
            'all_Subject'=>SubjectStup::orderBy('id')->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //show resources/Admin/Setup/Subject/create.blade.php
        return view('Admin.Setup.Subject.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // SubjectSetup Validate Start
        $request->validate([
            'subject_name'=>"required|unique:subject_stups,subject_name",
            'subject_code'=>"required|unique:subject_stups,subject_code"
        ]);
        // SubjectSetup Validate End

        // SubjectSetup Insert Code Start
        SubjectStup::insert($request->except('_token')+[
            'user_id'=>Auth::id(),
            'created_at'=>Carbon::now()
        ]);
        // SubjectSetup Insert Code End
        return redirect(route('subjectsetup.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SubjectStup  $subjectStup
     * @return \Illuminate\Http\Response
     */
    public function show(SubjectStup $subjectStup)
    {
        //show resources/Admin/Setup/Subject/show.blade.php
        return view('Admin.Setup.Subject.show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SubjectStup  $subjectStup
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //show resources/Admin/Setup/Subject/edit.blade.php

        return view('Admin.Setup.Subject.edit',[
            'subject'=>SubjectStup::where('id',$id)->first(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SubjectStup  $subjectStup
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        // SubjectSetup Validate Start
        $request->validate([
            'subject_name'=>"required|unique:subject_stups,subject_name,$id",
            'subject_code'=>"required|unique:subject_stups,subject_code,$id"
        ]);
        // SubjectSetup Validate End
        $subjectStup = SubjectStup::where('id',$id)->first();
         // subjectStup Update Code Start
         $subjectStup->update($request->except('_method','_token'));
         // subjectStup Update Code End

         return redirect(route('subjectsetup.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SubjectStup  $subjectStup
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $SubjectStup = SubjectStup::where('id',$id)->first();
        $SubjectStup->delete();
        return back();
    }
}
