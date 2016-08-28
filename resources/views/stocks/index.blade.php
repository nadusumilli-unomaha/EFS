<!-- The header section extending the app.blade.php -->
@extends('layouts/app')
<!-- The content section after the header above for this page. -->
@section('content')

    <!-- <nav class="navbar navbar-inverse">
        <div class="container-fluid">
        <div class="navbar-header">
          <a class="navbar-brand" href="/efs-new/public">EFS</a>
        </div>
        <ul class="nav navbar-nav">
            <li><a href="{{ action('CustomerController@index') }}">Customers</a></li>
            <li class="active"><a href="{{ action('StockController@index') }}">Stocks</a></li>
            <li><a href="{{ action('InvestmentController@index') }}">Investments</a></li>
        </ul>
      </div>
    </nav> -->

    <div class="container">
            <h1>Stock</h1>
            <a class="btn btn-primary pull-right" href="{{ URL::previous() }}">Go Back</a>
            <a href="{{url('/stocks/create')}}" class="btn btn-success">Create Stock</a>
            <hr>

        <!-- Table to display the detailed stock information of all the stocks. -->
            <table class="table table-striped table-bordered table-hover">
                <thead>
                <tr class="bg-info">
                    <th>Cust No</th>
                    <th>Cust Name</th>
                    <th>Symbol</th>
                    <th>Name</th>
                    <th>Shares</th>
                    <th>Purchase price</th>
                    <th>Purchase Date</th>
                    <th>Latest Stock Price</th>
                    <th>Total Stock Value</th>
                    <th>Gain or Loss</th>
                    <th colspan="3">Actions</th>
                </tr>
                </thead>
                <tbody>        @foreach ($stocks as $stock)
                    <tr>
                        <td>{{ $stock->customer->cust_number }}</td>
                        <td>{{ $stock->customer->name }}</td>
                        <td>{{ $stock->symbol }}</td>
                        <td>{{ $stock->name }}</td>
                        <td>{{ $stock->shares }}</td>
                        <td>{{ $stock->purchase_price }}$</td>
                        <td>{{ $stock->purchased }}</td>
                        <td>
                            <!-- Extracting stock price information from a website using in-built php functions. -->
                            <?php
                                $xmlurl = "http://dev.markitondemand.com/Api/v2/Quote?symbol=".$stock->symbol;
                                $xml=simplexml_load_file($xmlurl);
                                echo $xml->LastPrice   
                            ?>$
                        </td>
                              <!-- Doing some Calculation from the values obtained above to provide a detailed stock information. -->
                              <?php $var = round(floatval($stock->purchase_price) * floatval($stock->shares),2);
                              $LatestStockValue = round(floatval($stock->shares) * floatval($xml->LastPrice),2);
                              $GainorLoss = round($LatestStockValue - $var,2);?>
                        <td>{{ $var }}$</td>
                        <td>{{ $GainorLoss }}$</td>
                        <td><a href="{{url('stocks',$stock->id)}}" class="btn btn-primary">Read</a></td>
                        <td><a href="{{route('stocks.edit',$stock->id)}}" class="btn btn-warning">Update</a></td>
                        <td>
                            {!! Form::open(['method' => 'DELETE', 'route'=>['stocks.destroy', $stock->id]]) !!}
                            {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                            {!! Form::close() !!}
                        </td>
                    </tr>
                @endforeach

                </tbody>

            </table>
    </div>
@endsection
