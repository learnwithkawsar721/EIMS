<?php

namespace App\Http\Controllers;

use App\Models\ClassSetup;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClassSetupController extends Controller
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
        //show resources/Admin/Setup/Class/index.blade.php
        return view('Admin.Setup.Class.index',[
            'all_class'=>ClassSetup::orderBy('id')->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //show resources/Admin/Setup/Class/create.blade.php
        return view('Admin.Setup.Class.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // classSetup Validate Start
        $request->validate([
            'class_name'=>"required|unique:class_setups,class_name"
        ]);
        // classSetup Validate End

        // ClassSetUP Insert Code Start
        ClassSetup::insert($request->except('_token')+[
            'user_id'=>Auth::id(),
            'created_at'=>Carbon::now()
        ]);
        // ClassSetUP Insert Code End
        return redirect(route('classSetup.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ClassSetup  $classSetup
     * @return \Illuminate\Http\Response
     */
    public function show(ClassSetup $classSetup)
    {
        //show resources/Admin/Setup/Class/show.blade.php
        return view('Admin.Setup.Class.show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ClassSetup  $classSetup
     * @return \Illuminate\Http\Response
     */
    public function edit(ClassSetup $classSetup)
    {
        //show resources/Admin/Setup/Class/edit.blade.php
        return view('Admin.Setup.Class.edit',[
            'class'=>$classSetup
        ]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ClassSetup  $classSetup
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ClassSetup $classSetup)
    {
        // classSetup Validate Start
        $request->validate([
            'class_name'=>"required|unique:class_setups,class_name,$classSetup->id"
        ]);
        // classSetup Validate End

        // ClassSetUp Update Code Start
        $classSetup->update($request->except('_method','_token'));
        // ClassSetUp Update Code End

        return redirect(route('classSetup.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ClassSetup  $classSetup
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
       $classSetup = ClassSetup::where('id',$id)->first();
       $classSetup->delete();
       return back();
    }
}
