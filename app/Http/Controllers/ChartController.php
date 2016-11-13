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
        if(\Input::has('startdate')){
            $expenseQuery->where('date', '>=', \Input::get('startdate'));
            $invoiceQuery->where('due_date', '>=', \Input::get('startdate'));
        }

        // check if input Chart end date exists
        if(\Input::has('enddate')) {
            $expenseQuery->where('date', '<=', \Input::get('enddate'));
            $invoiceQuery->where('due_date', '<=', \Input::get('enddate'));
        }

        // confirm query
        $expensesArray = $expenseQuery->get();
        $invoicesArray = $invoiceQuery->get();

        // define month labels and datasets for chart
        $expensesChart = [];
        $invoicesChart = [];
        $monthsChart   = [];

        // calculate months period and fill $monthsChart array
        $start    = (new \DateTime(\Input::get('startdate')))->modify('first day of this month');
        $end      = (new \DateTime(\Input::get('enddate')))->modify('first day of next month');
        $interval = \DateInterval::createFromDateString('1 month');
        $period   = new \DatePeriod($start, $interval, $end);

        foreach ($period as $dt) {
            $monthsChart[] = [$dt->format("m"), $dt->format("Y")];
        }

        // loop expenses and invoices and fill arrays $expensesChart and $invoicesChart in right order
        for ($i=$start; $i < $end; $i->modify('+1 day')){
            $expensesChart[$i->format("m-Y")] = 0;
            $invoicesChart[$i->format("m-Y")] = 0;
            foreach ($expensesArray as $expense){
                $date = date("n", strtotime($expense->date));
                if($date == $i->format("m")){
                    $expensesChart[$i->format("m-Y")] += $expense->amount;
                }
            }
            foreach ($invoicesArray as $invoice){
                $date = date("n", strtotime($invoice->due_date));
                if($date == $i->format("m")){
                    $invoicesChart[$i->format("m-Y")] += $invoice->amount;
                }
            }

        }

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
                                    'expenseschart' => json_encode($expensesChart),
                                    'invoiceschart' => json_encode($invoicesChart),
                                    'monthschart'   => json_encode($monthsChart),
                                    'totalExpenses' => array_sum($totalExpenses),
                                    'totalInvoices' => array_sum($totalInvoices),
                                    'difference'    => array_sum($totalInvoices)-array_sum($totalExpenses)
                                    ]);
    }
}
