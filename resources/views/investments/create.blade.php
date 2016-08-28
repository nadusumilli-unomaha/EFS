@extends('layouts/app')
@section('content')
    <!-- A form to create the Investment values for each of the customer to create an Investment portfolio. -->
    <div class="container">
        <h1>Create New Investment</h1>
        <a class="btn btn-primary pull-right" href="{{ URL::previous() }}">Go Back</a>
        {!! Form::open(['url' => 'investments']) !!}
            <div class="form-group">
                    {!! Form::select('customer_id', $customers) !!}
                <!-- @if(Auth::user()->email == 'admin@admin.com')
                @else
                    {!! Form::select('customer_id', [Session::get("login_name")]) !!}
                @endif -->
            </div>
            <div class="form-group {{ $errors->has('category') ? ' has-error has-feedback' : '' }}">
                {!! Form::label('category', 'Category:') !!}
                {!! Form::text('category',null,['class'=>'form-control']) !!}
                <span class="glyphicon glyphicon-remove form-control-feedback"></span>
                @if ($errors->has('category'))
                    <span class="help-block">
                        <strong>{{ $errors->first('category') }}</strong>
                    </span>
                @endif
            </div>
            <div class="form-group{{ $errors->has('description') ? ' has-error has-feedback' : '' }}">
                {!! Form::label('description', 'Investment Description:') !!}
                {!! Form::text('description',null,['class'=>'form-control']) !!}
                <span class="glyphicon glyphicon-remove form-control-feedback"></span>
                @if ($errors->has('description'))
                    <span class="help-block">
                        <strong>{{ $errors->first('description') }}</strong>
                    </span>
                @endif
            </div>
            <div class="form-group{{ $errors->has('acquired_value') ? ' has-error has-feedback' : '' }}">
                {!! Form::label('acquired_value', 'Acquired Value:') !!}
                {!! Form::text('acquired_value',null,['class'=>'form-control']) !!}
                <span class="glyphicon glyphicon-remove form-control-feedback"></span>
                @if ($errors->has('acquired_value'))
                    <span class="help-block">
                        <strong>{{ $errors->first('acquired_value') }}</strong>
                    </span>
                @endif
            </div>
            <div class="form-group{{ $errors->has('acquired_date') ? ' has-error has-feedback' : '' }}">
                {!! Form::label('acquired_date', 'Acquired Date:') !!}
                {!! Form::text('acquired_date',null,['class'=>'form-control']) !!}
                <span class="glyphicon glyphicon-remove form-control-feedback"></span>
                @if ($errors->has('acquired_date'))
                    <span class="help-block">
                        <strong>{{ $errors->first('acquired_date') }}</strong>
                    </span>
                @endif
            </div>
            <div class="form-group{{ $errors->has('recent_value') ? ' has-error has-feedback' : '' }}">
                {!! Form::label('recent_value', 'Recent Value:') !!}
                {!! Form::text('recent_value',null,['class'=>'form-control']) !!}
                <span class="glyphicon glyphicon-remove form-control-feedback"></span>
                @if ($errors->has('recent_value'))
                    <span class="help-block">
                        <strong>{{ $errors->first('recent_value') }}</strong>
                    </span>
                @endif
            </div>
            <div class="form-group{{ $errors->has('recent_date') ? ' has-error has-feedback' : '' }}">
                {!! Form::label('recent_date', 'Recent Date:') !!}
                {!! Form::text('recent_date',null,['class'=>'form-control']) !!}
                <span class="glyphicon glyphicon-remove form-control-feedback"></span>
                @if ($errors->has('recent_date'))
                    <span class="help-block">
                        <strong>{{ $errors->first('recent_date') }}</strong>
                    </span>
                @endif
            </div>
            <div class="form-group">
                {!! Form::submit('Save', ['class' => 'btn btn-primary form-control']) !!}
            </div>
        {!! Form::close() !!}
    </div>
@stop
