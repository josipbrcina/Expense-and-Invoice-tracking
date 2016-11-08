@extends('layouts.pageslayout')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 ">
            @if (Session::has('message'))
            <h2 align="center">{{ Session::get('message') }}</h2>
            @endif
            <h4 align="center"> List of all invoices</h4>
            <a href="{{ URL::to('invoices/create') }}" class="btn btn-default">Add new invoice</a>
            <table class="table table-striped table-bordered">
                <thead>
                <tr>
                    <td>ID</td>
                    <td>Invoice due date</td>
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
                        <td>{{ $invoice->dateTime }}</td>
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

<script>

    function ConfirmDelete()
    {
        var x = confirm("Are you sure you want to delete?");
        if (x)
            return true;
        else
            return false;
    }

</script>

