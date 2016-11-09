@extends('layouts.pageslayout')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 ">
            @if (Session::has('message'))
            <h2 align="center">{{ Session::get('message') }}</h2>
            @endif
            <h4 align="center"> List of all expenses</h4>
            <a href="{{ URL::to('expenses/create') }}" class="btn btn-default">Add new expense</a>
            <table class="table table-striped table-bordered">
                <thead>
                <tr>
                    <td>ID</td>
                    <td>Type</td>
                    <td>Name</td>
                    <td>Amount</td>
                    <td>Company</td>
                    <td>Created at</td>
                    <td>Updated at</td>
                    <td>Added by User</td>
                    <td>Actions</td>
                </tr>
                </thead>
                <tbody>
                @foreach($expenses as $expense)
                    <tr>
                        <td>{{ $expense->id }}</td>
                        <td>{{ $expense->type }}</td>
                        <td>{{ $expense->name }}</td>
                        <td>{{ $expense->amount }}</td>
                        <td>{{ $expense->company->name }}</td>
                        <td>{{ $expense->created_at }}</td>
                        <td>{{ $expense->updated_at }}</td>
                        <td>{{ $expense->user->name }}</td>


                        <td>

                            <a class="btn btn-primary" href="{{ URL::to('expenses/' . $expense->id . '/edit') }}">Edit</a>
                            {{ Form::open(array('url' => 'expenses/' . $expense->id, 'class' => 'pull-right', 'onsubmit' => 'return ConfirmDelete()')) }}
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




