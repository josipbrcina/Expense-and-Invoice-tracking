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
        $expenseQuery = Expense::query();
        $invoiceQuery = Invoice::query();

        // check if input Chart start date exists
        if(\Input::has('startdate')){
            $expenseQuery->where('date', '>=', \Input::get('startdate'));
            $invoiceQuery->where('due_date', '>=', \Input::get('startdate'));
            $start = (new \DateTime(\Input::get('startdate')))->modify('first day of this month');
        } else {
            $start = (new \DateTime('1 year ago'))->modify('first day of this month');
        }

        // check if input Chart end date exists
        if(\Input::has('enddate')) {
            $expenseQuery->where('date', '<=', \Input::get('enddate'));
            $invoiceQuery->where('due_date', '<=', \Input::get('enddate'));
            $end = (new \DateTime(\Input::get('enddate')))->modify('first day of next month');
        } else {
            $end = (new \DateTime())->modify('first day of this month');
        }

        // confirm query
        $expensesArray = $expenseQuery->get();
        $invoicesArray = $invoiceQuery->get();

        // define month labels and datasets for chart and report
        $expensesChart = [];
        $invoicesChart = [];
        $monthsChart   = [];


        // calculate months period and fill $monthsChart array
        $interval = \DateInterval::createFromDateString('1 month');
        $period   = new \DatePeriod($start, $interval, $end);

        foreach ($period as $dt) {
            $monthsChart[] = [$dt->format("F"), $dt->format("Y")];
        }

        // loop expenses and invoices and fill arrays $expensesChart and $invoicesChart in right order
        for ($i=$start; $i < $end; $i->modify('+1 day')){
            $expensesChart[$i->format("m-Y")] = 0;
            $invoicesChart[$i->format("m-Y")] = 0;
            foreach ($expensesArray as $expense){
                $date = date("m-Y", strtotime($expense->date));
                if($date == $i->format("m-Y")){
                    $expensesChart[$i->format("m-Y")] += $expense->amount;
                }
            }
            foreach ($invoicesArray as $invoice){
                $date = date("m-Y", strtotime($invoice->due_date));
                if($date == $i->format("m-Y")){
                    $invoicesChart[$i->format("m-Y")] += $invoice->amount;
                }
            }

        }
        // format expenses and invoices array for chart display
        $tmpExpenses = [];
        foreach ($expensesChart as $expense){
            $tmpExpenses[] = $expense;
        }
        $expensesChart = $tmpExpenses;

        $tmpInvoices = [];
        foreach ($invoicesChart as $invoice){
            $tmpInvoices[] = $invoice;
        }
        $invoicesChart = $tmpInvoices;

        //calculate total expenses and invoices
        $totalExpenses = array_sum($expensesChart);
        $totalInvoices = array_sum($invoicesChart);

        // return view with all required data for displaying chart and report
        return View('pages.chart', [
                                    'expenseschart' => json_encode($expensesChart),
                                    'invoiceschart' => json_encode($invoicesChart),
                                    'monthschart'   => json_encode($monthsChart),
                                    'totalExpenses' => $totalExpenses,
                                    'totalInvoices' => $totalInvoices,
                                    'difference'    => $totalInvoices-$totalExpenses
                                    ]);
    }

}
