<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\ExpensesSetUp;
use Illuminate\Support\Facades\Auth;

class ExpensesSetUpController extends Controller
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
         //show resources/Admin/Setup/Expenses/index.blade.php
         return view('Admin.Setup.Expenses.index',[
            'all_expenses'=>ExpensesSetUp::orderBy('id')->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //show resources/Admin/Setup/Expenses/create.blade.php
        return view('Admin.Setup.Expenses.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // ExpensesSetup Validate Start
        $request->validate([
            'expenses_name'=>"required|unique:expenses_set_ups,expenses_name",
        ]);
        // ExpensesSetup Validate End
        // ExpensesSetup Insert Code Start
        ExpensesSetUp::insert($request->except('_token')+[
            'user_id'=>Auth::id(),
            'created_at'=>Carbon::now()
        ]);
        // ExpensesSetup Insert Code End

        return redirect(route('expensessetup.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ExpensesSetUp  $expensesSetUp
     * @return \Illuminate\Http\Response
     */
    public function show(ExpensesSetUp $expensesSetUp)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ExpensesSetUp  $expensesSetUp
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //show resources/Admin/Setup/Expenses/edit.blade.php
        return view('Admin.Setup.Expenses.edit',[
            'expenses'=>ExpensesSetUp::where('id',$id)->first(),
        ]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ExpensesSetUp  $expensesSetUp
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        // ExpensesSetup Validate Start
         $request->validate([
             'expenses_name'=>"required|unique:expenses_set_ups,expenses_name,$id",
         ]);
        // ExpensesSetup Validate End
        $expensesSetUp = ExpensesSetUp::where('id',$id)->first();

        // expensesSetUp update Code Start
       $expensesSetUp->update($request->except('_method','_token'));
        // expensesSetUp update Code End
        return redirect(route('expensessetup.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ExpensesSetUp  $expensesSetUp
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $SubjectStup = ExpensesSetUp::where('id',$id)->first();
        $SubjectStup->delete();
        return back();
    }
}
