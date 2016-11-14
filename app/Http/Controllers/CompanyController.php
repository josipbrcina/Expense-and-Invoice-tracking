<?php

namespace App\Http\Controllers;

use App\Company;
use Illuminate\Http\Request;


class CompanyController extends Controller
{

    /**
     * CompanyController constructor.
     */
    public function __construct()
    {
        /**
         * The middleware registered on the controller.
         *
         * @var
         */
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $allCompanies = Company::all();
        return View('pages.companies.index')->withCompanies($allCompanies);
    }

    /**
     * Search Companies based on Input
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function search()
    {
        $company = Company::query();

        if(\Input::has('value')){
            $company->where(\Input::get('field'), 'LIKE', '%' . \Input::get('value') . '%');
        }

        return View('pages.companies.index', ['companies' => $company->get()]);


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return View('pages.companies.create');
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
            'OIB'        => 'required|regex:/^([0-9]{11})$/i',
            'name'       => 'required',
            'address'    => 'required',
        );
        $validator = \Validator::make(\Input::all(), $rules);

        /**
         * Redirection if validator fails
         */
        if ($validator->fails()) {
            return \Redirect::to('companies/create')
                ->withErrors($validator)
                ->withInput(\Input::except('name', 'address'));
        } else {

            /**
             * If everything is ok store data
             */
            $company = new Company;
            $company->OIB        = \Input::get('OIB');
            $company->name       = \Input::get('name');
            $company->address    = \Input::get('address');
            $company->user_id    = \Input::get('user_id');
            $company->save();

            /**
             * redirect after success
             */
            \Session::flash('message', 'Successfully created company!');
            return \Redirect::to('companies');
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
        $company = Company::find($id);

        return view('pages.companies.edit')->withCompany($company);
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
            'OIB'        => 'required',
            'name'       => 'required',
            'address'    => 'required'
        );
        $validator = \Validator::make(\Input::all(), $rules);

        /**
         * Redirection if validator fails
         */
        if ($validator->fails()) {
            return \Redirect::to('companies/' . $id . '/edit')
                ->withErrors($validator)
                ->withInput(\Input::except('name', 'address'));
        } else {

            /**
             * If everything is ok store data
             */
            $company = Company::find($id);
            $company->OIB        = \Input::get('OIB');
            $company->name       = \Input::get('name');
            $company->address    = \Input::get('address');
            $company->user_id    = \Input::get('user_id');
            $company->save();

            /**
             * redirect after success
             */
            \Session::flash('message', 'Successfully updated company!');
            return \Redirect::to('companies');
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
        $company = Company::find($id);
        $company->delete();

        \Session::flash('message', 'Successfully deleted the company!');
        return \Redirect::to('companies');
    }
}
