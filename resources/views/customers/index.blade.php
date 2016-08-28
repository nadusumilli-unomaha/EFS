@extends('layouts/app')

@section('content')
<!-- 
    The navbar that highlights the customer section in the main index page which displays all the customers that are present in the eagle financial database.
    <nav class="navbar navbar-inverse">
        <div class="container-fluid">
        <div class="navbar-header">
          <a class="navbar-brand" href="/efs-new/public">EFS</a>
        </div>
        <ul class="nav navbar-nav">
            <li class="active"><a href="{{ action('CustomerController@index') }}">Customers</a></li>
            <li><a href="{{ action('StockController@index') }}">Stocks</a></li>
            <li><a href="{{ action('InvestmentController@index') }}">Investments</a></li>
        </ul>
      </div>
    </nav>
 -->
    <!-- A Customer table that displays all the customers and their information. -->
    <div class="container">
        @if(Session::has("cust_edit_msg"))
            <div class="alert alert-danger">
              <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
              <strong>Danger!</strong> {{Session::get("cust_edit_msg")}}
            </div>
        @endif
        <h1>{{ Auth::user()->name }}</h1>
        <?php $bool = 0;?>
        @if(Auth::user()->email == 'admin@admin.com')
        <a href="{{url('/customers/create')}}" class="btn btn-success">Create Customer</a>
        <a href="{{action('StockController@index')}}" style="margin: 0px 10px 0px 10px;" class="btn btn-success pull-right">Stocks</a>
        <a href="{{action('InvestmentController@index')}}" class="btn btn-success pull-right">Investments</a>
        @endif
        <hr>
        <table class="table table-striped table-bordered table-hover">
            <thead>
            <tr class="bg-info">
                <th>Cust Number</th>
                <th>Name</th>
                <th>Address</th>
                <th>City</th>
                <th>State</th>
                <th>Zip</th>
                <th>Primary Email</th>
                <th>Home Phone</th>
                <th>Cell Phone</th>
                <th colspan="3">Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($customers as $customer)
                <tr>
                    <!--The differentiation between admin and other users. password:Admin123-->
                    @if ((!Auth::guest() && Auth::user()->email == $customer->email)||(Auth::user()->email == 'admin@admin.com'))
                        <?php Session::set('login_id', $customer->id); Session::set('login_name', $customer->name);?>
                        <td>{{ $customer->cust_number }}</td>
                        <td>{{ $customer->name }}</td>
                        <td>{{ $customer->address }}</td>
                        <td>{{ $customer->city }}</td>
                        <td>{{ $customer->state }}</td>
                        <td>{{ $customer->zip }}</td>
                        <td>{{ $customer->email }}</td>
                        <td>{{ $customer->home_phone }}</td>
                        <td>{{ $customer->cell_phone }}</td>
                        <td><a href="{{url('customers',$customer->id)}}" class="btn btn-primary">Read</a></td>
                        <td><a href="{{route('customers.edit',$customer->id)}}" class="btn btn-warning">Update</a></td>
                        <td>
                            {!! Form::open(['method' => 'DELETE', 'route'=>['customers.destroy', $customer->id]]) !!}
                            {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                            {!! Form::close() !!}
                        </td>
                        <?php $bool = 1;?>
                    @endif
                </tr>
            @endforeach
            </tbody>
        </table>
        <?php if ($bool == 0 && Auth::user()->email != 'admin@admin.com') { ?>                  
            <a href="{{url('/customers/create')}}" class="btn btn-success">Create Profile</a>
        <?php } $bool = 1;?>
    </div>
@endsection
