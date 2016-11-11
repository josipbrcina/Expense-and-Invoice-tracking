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

    // Chart view generator time generator
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



        // calculate expenses and invoices for each month for Chart display

        $expensesChart = [];
        $invoicesChart = [];

            // loop and fill expensesChart array with month => total expenses
        foreach ($expensesArray as $expense){
                $date = date("n", strtotime($expense->date));
                if(empty($expensesChart)){
                    $expensesChart[$date] = $expense->amount;
                } elseif (key_exists($date, $expensesChart)){
                    $expensesChart[$date] += $expense->amount;
                } else {
                    $expensesChart[$date] = $expense->amount;
                }
        }

            // loop and fill invoicesChart array with month => total invoices

        foreach ($invoicesArray as $invoice){
            $date = date("n", strtotime($invoice->due_date));
            if(empty($invoicesChart)){
                $invoicesChart[$date] = $invoice->amount;
            } elseif (key_exists($date, $invoicesChart)){
                $invoicesChart[$date] += $invoice->amount;
            } else {
                $invoicesChart[$date] = $invoice->amount;
            }
        }

        // sort expensesChart and invoicesChart array by month (low to high)

        ksort($expensesChart);
        ksort($invoicesChart);


        // find total number of Expenses and Invoices for view report
        $totalExpenses = [];
        $totalInvoices = [];

        foreach ($expensesArray as $expense){
            $totalExpenses[] = $expense->amount;
        }

        foreach ($invoicesArray as $invoice){
            $totalInvoices[] = $invoice->amount;
        }

        // return view with all required data for displaying chart and report
        return View('pages.chart', [
                                    'expenses' => $expensesArray,
                                    'invoices' => $invoicesArray,
                                    'totalExpenses' => array_sum($totalExpenses),
                                    'totalInvoices' => array_sum($totalInvoices),
                                    'difference'    => array_sum($totalInvoices)-array_sum($totalExpenses)
                                    ]);
    }
}
