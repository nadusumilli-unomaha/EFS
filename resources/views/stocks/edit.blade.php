@extends('layouts/app')
@section('content')
    <!-- A form to update the stock values that are stored in the database. -->
    <div class="container">
        <h1>Update Stock</h1>
        {!! Form::model($stock,['method' => 'PATCH','route'=>['stocks.update',$stock->id]]) !!}
           <div class="form-group">
            {!! Form::label('symbol', 'Symbol:') !!}
            {!! Form::text('symbol',null,['class'=>'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('name', 'St Name:') !!}
            {!! Form::text('name',null,['class'=>'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('shares', 'Shares:') !!}
            {!! Form::text('shares',null,['class'=>'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('purchase_price', 'Purchase Price:') !!}
            {!! Form::text('purchase_price',null,['class'=>'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('purchased', 'Purchase Date:') !!}
            {!! Form::text('purchased',null,['class'=>'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::submit('Update', ['class' => 'btn btn-primary']) !!}
        </div>
        {!! Form::close() !!}
        <a class="btn btn-primary" href="{{ URL::previous() }}">Go Back</a>

    </div>
@stop
