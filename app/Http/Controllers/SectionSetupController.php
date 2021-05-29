<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\SectionSetup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SectionSetupController extends Controller
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
         //show resources/Admin/Setup/Section/index.blade.php
         return view('Admin.Setup.Section.index',[
            'all_Section'=>SectionSetup::orderBy('id')->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         //show resources/Admin/Setup/Section/create.blade.php
         return view('Admin.Setup.Section.create');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

         // SectionSetup Validate Start
         $request->validate([
            'section_name'=>"required|unique:section_setups,section_name",
        ]);
        // SectionSetup Validate End
        // SectionSetup Insert Code Start
        SectionSetup::insert($request->except('_token')+[
            'user_id'=>Auth::id(),
            'created_at'=>Carbon::now()
        ]);
        // SectionSetup Insert Code End
        return redirect(route('sectionSetup.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SectionSetup  $sectionSetup
     * @return \Illuminate\Http\Response
     */
    public function show(SectionSetup $sectionSetup)
    {
         //show resources/Admin/Setup/Section/show.blade.php
         return view('Admin.Setup.Section.show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SectionSetup  $sectionSetup
     * @return \Illuminate\Http\Response
     */
    public function edit(SectionSetup $sectionSetup)
    {

         //show resources/Admin/Setup/Section/edit.blade.php
         return view('Admin.Setup.Section.edit',[
             'section'=>$sectionSetup
         ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SectionSetup  $sectionSetup
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SectionSetup $sectionSetup)
    {

         // SectionSetup Validate Start
         $request->validate([
            'section_name'=>"required|unique:section_setups,section_name,$sectionSetup->id",
        ]);
        // SectionSetup Validate End

          // SectionSetup update Code Start
         $sectionSetup->update($request->except('_method','_token'));
        // SectionSetup update Code End
        return redirect(route('sectionSetup.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SectionSetup  $sectionSetup
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $SubjectStup = SectionSetup::where('id',$id)->first();
        $SubjectStup->delete();
        return back();
    }
}
