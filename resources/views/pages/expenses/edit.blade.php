@extends('layouts.pageslayout')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-2">
                <p align="center">Edit expense : {{ $expense->name }}</p>
                {{ Form::model($expense, array('route' => array('expenses.update', $expense->id), 'method' => 'PATCH')) }}

                {{ Html::ul($errors->all()) }}

                <div class="form-group">
                    {{ Form::label('type', 'Type') }}
                    {{ Form::text('type', Input::old('type'), array('class' => 'form-control')) }}
                </div>

                <div class="form-group">
                    {{ Form::label('name', 'Name') }}
                    {{ Form::text('name', Input::old('name'), array('class' => 'form-control')) }}
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

                {{ Form::submit('Edit existing Expense!', array('class' => 'btn btn-primary')) }}
                <button class="btn btn-danger" onclick="history.go(-1)";> Cancel </button>

                {{ Form::close() }}

            </div>
        </div>
    </div>
@endsection










