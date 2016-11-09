@extends('layouts.pageslayout')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 ">
            @if (Session::has('message'))
            <h2 align="center">{{ Session::get('message') }}</h2>
            @endif
            <h4 align="center"> List of all companies</h4>
            <a href="{{ URL::to('companies/create') }}" class="btn btn-default">Add new company</a>
                {{ Form::open(array('url' => '/search-companies', 'method' => 'get', 'class' => 'pull-right')) }}

                {{ Form::select('field', array('name' => 'Company name', 'OIB' => 'OIB'))}}
                {{ Form::text('value', Input::old('value'), array('class' => 'form-control')) }}

                {{ Form::submit('Search', array('class' => 'btn btn-primary')) }}
                {{ Form::close() }}
            <table class="table table-striped table-bordered">
                <thead>
                <tr>
                    <td>ID</td>
                    <td>OIB</td>
                    <td>Name</td>
                    <td>Address</td>
                    <td>Created at</td>
                    <td>Updated at</td>
                    <td>Added by User</td>
                    <td>Actions</td>
                </tr>
                </thead>
                <tbody>
                @foreach($companies as $company)
                    <tr>
                        <td>{{ $company->id }}</td>
                        <td>{{ $company->OIB }}</td>
                        <td>{{ $company->name }}</td>
                        <td>{{ $company->address }}</td>
                        <td>{{ $company->created_at }}</td>
                        <td>{{ $company->updated_at }}</td>

                        <td>{{ $company->user->name }}</td>


                        <td>

                            <a class="btn btn-small btn-primary" href="{{ URL::to('companies/' . $company->id . '/edit') }}">Edit</a>
                            {{ Form::open(array('url' => 'companies/' . $company->id, 'class' => 'pull-right', 'onsubmit' => 'return ConfirmDelete()')) }}
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




