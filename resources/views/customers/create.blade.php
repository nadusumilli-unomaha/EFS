@extends('layouts/app')
@section('content')

    <!-- A form to create and add a new customer to the eagle financial services portfolio. -->
    <div class="container">
        <a class="btn btn-primary pull-right" style="margin: 10px 10px 10px 10px;" href="{{ URL::previous() }}">Go Back</a>
        <h1>Create New Customer</h1>
        {!! Form::open(['url' => 'customers']) !!}
        <div class="form-group {{ $errors->has('name') ? ' has-error has-feedback' : '' }}">
            {!! Form::label('name', 'Name:') !!}
            {!! Form::text('name',null,['class'=>'form-control']) !!}
            <span class="glyphicon glyphicon-remove form-control-feedback"></span>
            @if ($errors->has('name'))
                <span class="help-block">
                    <strong>{{ $errors->first('name') }}</strong>
                </span>
            @endif
        </div>
        <div class="form-group {{ $errors->has('cust_number') ? ' has-error has-feedback' : '' }}">
            {!! Form::label('cust_number', 'Customer ID') !!}
            {!! Form::text('cust_number',null,['class'=>'form-control']) !!}
            <span class="glyphicon glyphicon-remove form-control-feedback"></span>
            @if ($errors->has('cust_number'))
                <span class="help-block">
                    <strong>{{ $errors->first('cust_number') }}</strong>
                </span>
            @endif
        </div>
        <div class="form-group {{ $errors->has('address') ? ' has-error has-feedback' : '' }}">
            {!! Form::label('address', 'Street Address:') !!}
            {!! Form::text('address',null,['class'=>'form-control'] ) !!}
            <span class="glyphicon glyphicon-remove form-control-feedback"></span>
            @if ($errors->has('address'))
                <span class="help-block">
                    <strong>{{ $errors->first('address') }}</strong>
                </span>
            @endif
        </div>
        <div class="form-group {{ $errors->has('city') ? ' has-error has-feedback' : '' }}">
            {!! Form::label('city', 'City:') !!}
            {!! Form::text('city',null,['class'=>'form-control']) !!}
            <span class="glyphicon glyphicon-remove form-control-feedback"></span>
            @if ($errors->has('city'))
                <span class="help-block">
                    <strong>{{ $errors->first('city') }}</strong>
                </span>
            @endif
        </div>
        <div class="form-group {{ $errors->has('state') ? ' has-error has-feedback' : '' }}">
            {!! Form::label('state', 'State:') !!}
            {!! Form::text('state',null,['class'=>'form-control']) !!}
            <span class="glyphicon glyphicon-remove form-control-feedback"></span>
            @if ($errors->has('state'))
                <span class="help-block">
                    <strong>{{ $errors->first('state') }}</strong>
                </span>
            @endif
        </div>
        <div class="form-group {{ $errors->has('zip') ? ' has-error has-feedback' : '' }}">
            {!! Form::label('zip', 'Zip:') !!}
            {!! Form::text('zip',null,['class'=>'form-control']) !!}
            <span class="glyphicon glyphicon-remove form-control-feedback"></span>
            @if ($errors->has('zip'))
                <span class="help-block">
                    <strong>{{ $errors->first('zip') }}</strong>
                </span>
            @endif
        </div>
        <div class="form-group {{ $errors->has('email') ? ' has-error has-feedback' : '' }}">
            {!! Form::label('email', 'Primary Email:') !!}
            {!! Form::text('email',null,['class'=>'form-control']) !!}
            <span class="glyphicon glyphicon-remove form-control-feedback"></span>
            @if ($errors->has('email'))
                <span class="help-block">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
            @endif
        </div>
        <div class="form-group {{ $errors->has('home_phone') ? ' has-error has-feedback' : '' }}">
            {!! Form::label('home_phone', 'Home Phone:') !!}
            {!! Form::text('home_phone',null,['class'=>'form-control']) !!}
            <span class="glyphicon glyphicon-remove form-control-feedback"></span>
            @if ($errors->has('home_phone'))
                <span class="help-block">
                    <strong>{{ $errors->first('home_phone') }}</strong>
                </span>
            @endif
        </div>
        <div class="form-group {{ $errors->has('cell_phone') ? ' has-error has-feedback' : '' }}">
            {!! Form::label('cell_phone', 'Cell Phone:') !!}
            {!! Form::text('cell_phone',null,['class'=>'form-control']) !!}
            <span class="glyphicon glyphicon-remove form-control-feedback"></span>
            @if ($errors->has('cell_phone'))
                <span class="help-block">
                    <strong>{{ $errors->first('cell_phone') }}</strong>
                </span>
            @endif
        </div>
        <div class="form-group">
            {!! Form::submit('Save', ['class' => 'btn btn-primary form-control']) !!}
        </div>
        {!! Form::close() !!}

        <!-- Validating how the information can be added to the customer database. For details refer to the store function in customerController. -->
    </div>

@stop
