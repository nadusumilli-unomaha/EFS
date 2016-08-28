    @extends('layouts/app')
    @section('content')
    <!-- A form to create the stock values for each of the customer to create a stock portfolio. -->
    <div class="container">
        <h1>Create New Stock</h1>
        <a class="btn btn-primary pull-right" href="{{ URL::previous() }}">Go Back</a>
        {!! Form::open(['url' => 'stocks']) !!}
            <div class="form-group">
            <?php $hash = array(Session::get("login_id")=>Session::get("login_name")); ?>
            @if(Auth::user()->email == 'admin@admin.com')
                {!! Form::select('customer_id', $customers) !!}
            @else
                {!! Form::select('customer_id', $hash) !!}
            @endif
            </div>
            <div class="form-group{{ $errors->has('symbol') ? ' has-error has-feedback' : '' }}">
                {!! Form::label('symbol', 'Symbol:') !!}
                {!! Form::text('symbol',null,['class'=>'form-control']) !!}
                <span class="glyphicon glyphicon-remove form-control-feedback"></span>
                @if ($errors->has('symbol'))
                    <span class="help-block">
                        <strong>{{ $errors->first('symbol') }}</strong>
                    </span>
                @endif
            </div>
            <div class="form-group{{ $errors->has('name') ? ' has-error has-feedback' : '' }}">
                {!! Form::label('name', 'Stock Name:') !!}
                {!! Form::text('name',null,['class'=>'form-control']) !!}
                <span class="glyphicon glyphicon-remove form-control-feedback"></span>
                @if ($errors->has('name'))
                    <span class="help-block">
                        <strong>{{ $errors->first('name') }}</strong>
                    </span>
                @endif
            </div>
            <div class="form-group{{ $errors->has('shares') ? ' has-error has-feedback' : '' }}">
                {!! Form::label('shares', 'Shares:') !!}
                {!! Form::text('shares',null,['class'=>'form-control']) !!}
                <span class="glyphicon glyphicon-remove form-control-feedback"></span>
                @if ($errors->has('shares'))
                    <span class="help-block">
                        <strong>{{ $errors->first('shares') }}</strong>
                    </span>
                @endif
            </div>
            <div class="form-group{{ $errors->has('purchase_price') ? ' has-error has-feedback' : '' }}">
                {!! Form::label('purchase_price', 'Purchase Price:') !!}
                {!! Form::text('purchase_price',null,['class'=>'form-control']) !!}
                <span class="glyphicon glyphicon-remove form-control-feedback"></span>
                @if ($errors->has('purchase_price'))
                    <span class="help-block">
                        <strong>{{ $errors->first('purchase_price') }}</strong>
                    </span>
                @endif
            </div>
            <div class="form-group{{ $errors->has('purchased') ? ' has-error has-feedback' : '' }} ">
                {!! Form::label('purchased', 'Purchase Date:') !!}
                {!! Form::text('purchased',null,['class'=>'form-control']) !!}
                <span class="glyphicon glyphicon-remove form-control-feedback"></span>
                @if ($errors->has('purchased'))
                    <span class="help-block">
                        <strong>{{ $errors->first('purchased') }}</strong>
                    </span>
                @endif
            </div>
            <div class="form-group">
                {!! Form::submit('Save', ['class' => 'btn btn-primary form-control']) !!}
            </div>
        {!! Form::close() !!}
    </div>
@stop
