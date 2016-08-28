@extends('layouts/app')

@section('content')
    <!-- Creating the navbar for the Investment to highlight the investment selection on navbar. -->
    <!-- <nav class="navbar navbar-inverse">
        <div class="container-fluid">
        <div class="navbar-header">
          <a class="navbar-brand" href="/efs-new/public">EFS</a>
        </div>
        <ul class="nav navbar-nav">
            <li><a href="{{ action('CustomerController@index') }}">Customers</a></li>
            <li><a href="{{ action('StockController@index') }}">Stocks</a></li>
            <li class="active"><a href="{{ action('InvestmentController@index') }}">Investments</a></li>
        </ul>
      </div>
    </nav> -->
    
    <!-- Container that contains the table of all the investments information for all customers. -->
    <div class="container">
        <h1>Investment</h1>
        <a class="btn btn-primary pull-right" href="{{ URL::previous() }}">Go Back</a>
        <a href="{{ action('InvestmentController@create') }}" class="btn btn-success">Create Investment</a>
        <hr>
        <table class="table table-striped table-bordered table-hover">
            <thead>
            <tr class="bg-info">
                <th>Cust No</th>
                <th>Cust Name</th>
                <th>Category</th>
                <th>Description</th>
                <th>Acquired Value</th>
                <th>Acquired Date</th>
                <th>Recent Value</th>
                <th>Recent Date</th>
                <th colspan="3">Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($investments as $Investment)
                <tr>
                    <td>{{ $Investment->customer->cust_number }}</td>
                    <td>{{ $Investment->customer->name }}</td>
                    <td>{{ $Investment->category }}</td>
                    <td>{{ $Investment->description }}</td>
                    <td>${{ $Investment->acquired_value }}</td>
                    <td>{{ $Investment->acquired_date }}</td>
                    <td>${{ $Investment->recent_value }}</td>
                    <td>{{ $Investment->recent_date }}</td>
                    <td><a href="{{url('investments',$Investment->id)}}" class="btn btn-primary">Read</a></td>
                    <td><a href="{{route('investments.edit',$Investment->id)}}" class="btn btn-warning">Update</a></td>
                    <td>
                        {!! Form::open(['method' => 'DELETE', 'route'=>['investments.destroy', $Investment->id]]) !!}
                        {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                        {!! Form::close() !!}
                    </td>
                </tr>
            @endforeach

            </tbody>

        </table>
    </div>
@endsection
