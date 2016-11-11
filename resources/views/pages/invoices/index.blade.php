@extends('layouts.pageslayout')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-11 ">
            @if (Session::has('message'))
            <h2 align="center">{{ Session::get('message') }}</h2>
            @endif
            <h4 align="center"> List of all invoices</h4>
            <a href="{{ URL::to('invoices/create') }}" class="btn btn-default">Add new invoice</a>
                {{ Form::open(array('url' => '/search-invoices', 'method' => 'get', 'class' => 'form-horizontal')) }}
                <div class="col-xs-4 col-md-4">
                {{ Form::label('name', 'Company name') }}
                {{ Form::text('name', Input::old('name'), array('class' => 'form-control')) }}
                </div>
                <div class="col-xs-4 col-md-4">
                {{ Form::label('startdate', 'Start due_date') }}
                {{ Form::text('startdate', Input::old('startdate'), array('class' => 'form-control', 'id' => 'datepicker')) }}
                </div>
                <div class="col-xs-4 col-md-4">
                {{ Form::label('enddate', 'End due_date') }}
                {{ Form::text('enddate', Input::old('enddate'), array('class' => 'form-control', 'id' => 'datepicker2')) }}
                </div>
                <div class="col-xs-4 col-md-4">
                {{ Form::label('startamount', 'Amount (from)') }}
                {{ Form::text('startamount', Input::old('startamount'), array('class' => 'form-control')) }}
                </div>
                <div class="col-xs-4 col-md-4">
                {{ Form::label('endamount', 'Amount (to)') }}
                {{ Form::text('endamount', Input::old('endamount'), array('class' => 'form-control')) }}
                </div>
                <div class="col-xs-4 col-md-4">
                {{ Form::submit('Search', array('class' => 'btn btn-primary')) }}
                {{ Form::close() }}
                </div>

            <table class="table table-striped table-bordered">
                <thead>
                <tr>
                    <td>ID</td>
                    <td>Invoice due date</td>
                    <td>Amount</td>
                    <td>Company</td>
                    <td>Created at</td>
                    <td>Updated at</td>
                    <td>Added by User</td>
                    <td>Actions</td>
                </tr>
                </thead>
                <tbody>
                @foreach($invoices as $invoice)
                    <tr>
                        <td>{{ $invoice->id }}</td>
                        <td>{{ $invoice->due_date }}</td>
                        <td>{{ $invoice->amount }}</td>
                        <td>{{ $invoice->company->name }}</td>
                        <td>{{ $invoice->created_at }}</td>
                        <td>{{ $invoice->updated_at }}</td>
                        <td>{{ $invoice->user->name }}</td>


                        <td>

                            <a class="btn btn-primary" href="{{ URL::to('invoices/' . $invoice->id . '/edit') }}">Edit</a>
                            {{ Form::open(array('url' => 'invoices/' . $invoice->id, 'class' => 'pull-right', 'onsubmit' => 'return ConfirmDelete()')) }}
                            {{ Form::hidden('_method', 'DELETE') }}
                            {{ Form::submit('Delete', array('class' => 'btn btn-danger')) }}
                            {{ Form::close() }}

                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
