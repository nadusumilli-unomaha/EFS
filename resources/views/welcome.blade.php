@extends('layouts/app')
@section('content')
		<style type="text/css">
			
            .title {
                font-size: 96px;
                font-weight: 100;
                font-family: 'Lato', sans-serif;
            }
		</style>
        <!--Creating a container to center the text to the middle of the page.-->
        <div class="container">
            <div class="content">
                <div class="title">Eagle Financial Services </div>
                <!--A link to the customers index page.-->
                <!--<a href="{{ action('CustomerController@index') }}" class="btn btn-primary">Show Customers</a>-->
                <div class="panel panel-default">

                <div class="panel-body" >
                    <font face="sans-serif">We are a financial portfolio system. We manage the financial system's for each person.</font>
                </div>
            </div>
            </div>
        </div>
@stop
