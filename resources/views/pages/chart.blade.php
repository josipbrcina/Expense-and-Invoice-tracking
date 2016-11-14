@extends('layouts.chartlayout')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-7 col-md-offset-2">
            {{ Form::open(array('url' => '/chart', 'method' => 'get', 'class' => ' form-horizontal')) }}

            <div class="col-xs-4 col-md-4">
                {{ Form::label('startdate', 'Start date') }}
                {{ Form::text('startdate', Input::old('startdate'), array('class' => 'form-control', 'id' => 'datepicker')) }}
            </div>

            <div class="col-xs-4 col-md-4">
                {{ Form::label('enddate', 'End date') }}
                {{ Form::text('enddate', Input::old('enddate'), array('class' => 'form-control', 'id' => 'datepicker2')) }}
            </div>

            <div class="col-xs-4 col-md-4">
                {{ Form::submit('Generate', array('class' => 'btn btn-primary')) }}
                {{ Form::close() }}
            </div>
            <canvas id="chart" height="400" width="600"></canvas>
        </div>
            <div>
                <p> Total invoices : {{ $totalInvoices }} </p>
                <p> Total expenses : {{ $totalExpenses }} </p>
                <p> Difference : {{ $difference }} </p>
            </div>
    </div>
</div>
@endsection


