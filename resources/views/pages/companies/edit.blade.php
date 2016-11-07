@extends('layouts.pageslayout')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-2">
                <p align="center">Edit company : {{ $company->name }}</p>
                {{ Form::model($company, array('route' => array('companies.update', $company->id), 'method' => 'PATCH')) }}

                {{ Html::ul($errors->all()) }}

                <div class="form-group">
                    {{ Form::label('name', 'Name') }}
                    {{ Form::text('name', Input::old('name'), array('class' => 'form-control')) }}
                </div>

                <div class="form-group">
                    {{ Form::label('address', 'Address') }}
                    {{ Form::text('address', Input::old('address'), array('class' => 'form-control')) }}
                </div>
                {{ Form::hidden('user_id', Auth::user()->id) }}

                {{ Form::submit('Edit existing Company!', array('class' => 'btn btn-primary')) }}
                <button class="btn btn-danger" onclick="history.go(-1)";> Cancel </button>

                {{ Form::close() }}

            </div>
        </div>
    </div>
@endsection










