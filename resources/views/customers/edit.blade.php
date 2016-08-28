@extends('layouts/app')
@section('content')

    <!-- A form to update the Customer values that are stored in the eagle financial database. -->
    <div class="container">
    <h1>Update Customer</h1>
        <a class="btn btn-primary pull-right" style="margin: 10px 10px 10px 10px;" href="{{ URL::previous() }}">Go Back</a>
    {!! Form::model($customer,['method' => 'PATCH','route'=>['customers.update',$customer->id]]) !!}
    <div class="form-group">
        {!! Form::label('name', 'Name:') !!}
        {!! Form::text('name',null,['class'=>'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('cust_number', 'Cust Number') !!}
        {!! Form::text('cust_number',null,['class'=>'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('address', 'Street Address:') !!}
        {!! Form::text('address',null,['class'=>'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('city', 'City:') !!}
        {!! Form::text('city',null,['class'=>'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('state', 'State:') !!}
        {!! Form::text('state',null,['class'=>'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('zip', 'Zip:') !!}
        {!! Form::text('zip',null,['class'=>'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('email', 'Primary Email:') !!}
        {!! Form::text('email',null,['class'=>'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('home_phone', 'Home Phone:') !!}
        {!! Form::text('home_phone',null,['class'=>'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('cell_phone', 'Cell Phone:') !!}
        {!! Form::text('cell_phone',null,['class'=>'form-control']) !!}
    </div>

    <div class="form-group">
        {!! Form::submit('Update', ['class' => 'btn btn-primary']) !!}
    </div>
    {!! Form::close() !!}
    </div>
@stop
