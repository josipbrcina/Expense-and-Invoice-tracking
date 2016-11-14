@extends('layouts.pageslayout')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-2">
                <p align="center">Add new invoice</p>
                {{ Form::open(array('url' => 'invoices')) }}
                {{ Html::ul($errors->all()) }}

                <div class="form-group">
                    {{ Form::label('due_date', 'Due Date') }}
                    {{ Form::text('due_date', Input::old('due_date'), array('class' => 'form-control', 'id' => 'datepicker')) }}
                </div>

                <div class="form-group">
                    {{ Form::label('amount', 'Amount') }}
                    {{ Form::text('amount', Input::old('amount'), array('class' => 'form-control')) }}
                </div>

                <div class="form-group">
                    {{ Form::label('company_id' , 'Company') }}
                    {{ Form::select('company_id' , $companies) }}
                </div>

                    {{ Form::hidden('user_id', Auth::user()->id) }}
                    {{ Form::submit('Create new invoice!', array('class' => 'btn btn-primary')) }}
                    <button class="btn btn-danger" onclick="history.go(-1)";> Cancel </button>
                    {{ Form::close() }}
            </div>
        </div>
    </div>

@endsection









