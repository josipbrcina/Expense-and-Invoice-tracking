<?php

namespace App\Http\Controllers;

use App\Expense;
use App\Company;

use Illuminate\Http\Request;

class ExpenseController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $allExpenses = Expense::all();
        return View('pages.expenses.index')->withExpenses($allExpenses);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $companies = Company::all()->pluck('name' , 'id');
        return View('pages.expenses.create')->withCompanies($companies);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = array(
            'type'        => 'required',
            'name'        => 'required',
            'amount'      => 'required',
            'company_id'  => 'required'
        );
        $validator = \Validator::make(\Input::all(), $rules);

        // process the create
        if ($validator->fails()) {
            return \Redirect::to('expenses/create')
                ->withErrors($validator)
                ->withInput(\Input::except('type', 'name', 'amount', 'company_id'));
        } else {
            // store
            $expense = new Expense;
            $expense->type       = \Input::get('type');
            $expense->name       = \Input::get('name');
            $expense->amount     = \Input::get('amount');
            $expense->company_id = \Input::get('company_id');
            $expense->user_id    = \Input::get('user_id');
            $expense->save();

            // redirect
            \Session::flash('message', 'Successfully created expense!');
            return \Redirect::to('expenses');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $expense = Expense::find($id);
        $companies = Company::all()->pluck('name' , 'id');


        return view('pages.expenses.edit')->withExpense($expense)->withCompanies($companies);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $rules = array(
            'type'        => 'required',
            'name'        => 'required',
            'amount'      => 'required',
            'company_id'  => 'required'
        );
        $validator = \Validator::make(\Input::all(), $rules);

        // process the create
        if ($validator->fails()) {
            return \Redirect::to('expenses/' . $id .'/edit')
                ->withErrors($validator)
                ->withInput(\Input::except('type', 'name', 'amount', 'company_id'));
        } else {
            // store
            $expense = Expense::find($id);
            $expense->type       = \Input::get('type');
            $expense->name       = \Input::get('name');
            $expense->amount     = \Input::get('amount');
            $expense->company_id = \Input::get('company_id');
            $expense->user_id    = \Input::get('user_id');
            $expense->save();

            // redirect
            \Session::flash('message', 'Successfully updated expense!');
            return \Redirect::to('expenses');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // delete
        $expense = Expense::find($id);
        $expense->delete();

        //redirect

        \Session::flash('message', 'Successfully deleted expense!');
        return \Redirect::to('expenses');


    }
}
