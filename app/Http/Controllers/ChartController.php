<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Invoice;
use App\Expense;

class ChartController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('pages.chart');
    }

    // Chart view generator
    public function generate()
    {
        $expenseQuery = Expense::query();
        $invoiceQuery = Invoice::query();

        // check if input Chart start date exists
        if(\Input::has('startdate')) {
            $expenseQuery->where('date', '>=', \Input::get('startdate'));
            $invoiceQuery->where('due_date', '>=', \Input::get('startdate'));
        }

        // check if input Chart end date exists
        if(\Input::has('enddate')){
            $expenseQuery->where('date', '<=', \Input::get('enddate'));
            $invoiceQuery->where('due_date', '<=', \Input::get('enddate'));
        }

        // confirm query
        $expensesArray = $expenseQuery->get();
        $invoicesArray = $invoiceQuery->get();

        $totalExpenses = [];
        $totalInvoices = [];

        foreach ($expensesArray as $expense){
            $totalExpenses[] = $expense->amount;
        }

        foreach ($invoicesArray as $invoice){
            $totalInvoices[] = $invoice->amount;
        }


        return View('pages.chart', [
                                    'expenses' => $expensesArray,
                                    'invoices' => $invoicesArray,
                                    'totalExpenses' => array_sum($totalExpenses),
                                    'totalInvoices' => array_sum($totalInvoices),
                                    'difference'    => array_sum($totalInvoices)-array_sum($totalExpenses)
                                    ]);
    }
}
