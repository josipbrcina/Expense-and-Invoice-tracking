<?php

namespace App\Http\Controllers;

use App\Invoice;
use App\Company;
use Illuminate\Http\Request;

class InvoiceController extends Controller
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
        $allInvoices = Invoice::all();
        return View('pages.invoices.index')->withInvoices($allInvoices);
    }

    /**
     * Handle the search query in pages.invoices.index
     * @return search result
     *
     */
    public function search()
    {
        $companyQuery = Company::query();
        $invoiceQuery = Invoice::query();

        // check if input start due date exist
        if(\Input::has('startdate')) {
            $invoiceQuery->where('due_date', '>=', \Input::get('startdate'));
        }

        // check if input end due date exist
        if(\Input::has('enddate')){
            $invoiceQuery->where('due_date', '<=', \Input::get('enddate'));
        }

        // check if input amount (from) exist
        if(\Input::has('startamount')) {
            $invoiceQuery->where('amount', '>=', \Input::get('startamount'));
        }

        // check if input amount (to) exist
        if(\Input::has('endamount')){
            $invoiceQuery->where('amount', '<=', \Input::get('endamount'));
        }

        // confirm query
        $invoicesArray = $invoiceQuery->get();

        //check if input name exist, if do loop through Company
        if(\Input::has('name')) {
            $name = '%' . \Input::get('name') . '%';
            $companies = $companyQuery->where('name', 'LIKE', $name)->get();

            // loop through companies and invoices, find matched and fill array
            $tmpInvoices = [];
            foreach ($companies as $company){
                foreach ($invoicesArray as $invoice){
                    if($company->id == $invoice->company_id){
                        $tmpInvoices[] = $invoice;
                    } else {
                        continue;
                    }
                }
            }

            // revert variables - prepare for return into view
            $invoicesArray = $tmpInvoices;
        }

        return View('pages.invoices.index', ['invoices' => $invoicesArray]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $companies = Company::all()->pluck('name' , 'id');
        return View('pages.invoices.create')->withCompanies($companies);
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
            'due_date'    => 'required',
            'amount'      => 'required',
            'company_id'  => 'required'
        );
        $validator = \Validator::make(\Input::all(), $rules);

        // process the create
        if ($validator->fails()) {
            return \Redirect::to('invoices/create')
                ->withErrors($validator)
                ->withInput(\Input::except('due_date', 'company_id'));
        } else {
            // store
            $invoice = new invoice;
            $invoice->due_date   = \Input::get('due_date');
            $invoice->amount     = \Input::get('amount');
            $invoice->company_id = \Input::get('company_id');
            $invoice->user_id    = \Input::get('user_id');
            $invoice->save();

            // redirect
            \Session::flash('message', 'Successfully created invoice!');
            return \Redirect::to('invoices');
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
        $invoice = Invoice::find($id);
        $companies = Company::all()->pluck('name' , 'id');


        return view('pages.invoices.edit')->withInvoices($invoice)->withCompanies($companies);
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
            'due_date'    => 'required',
            'amount'      => 'required',
            'company_id'  => 'required'
        );
        $validator = \Validator::make(\Input::all(), $rules);

        // process the create
        if ($validator->fails()) {
            return \Redirect::to('invoices/' . $id . '/edit')
                ->withErrors($validator)
                ->withInput(\Input::except('due_date', 'company_id'));
        } else {
            // store
            $invoice = Invoice::find($id);
            $invoice->due_date   = \Input::get('due_date');
            $invoice->amount     = \Input::get('amount');
            $invoice->company_id = \Input::get('company_id');
            $invoice->user_id    = \Input::get('user_id');
            $invoice->save();

            // redirect
            \Session::flash('message', 'Successfully updated invoice!');
            return \Redirect::to('invoices');
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
        $invoice = Invoice::find($id);
        $invoice->delete();

        //redirect
        \Session::flash('message', 'Successfully deleted invoice!');
        return \Redirect::to('invoices');
    }
}
