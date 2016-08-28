@extends('layouts/app')
@section('content')
    
    <!-- A table that shows detailed informaiton of a particular customer. -->
    <div class="container">
        @if(Session::has("stock_succcess_created"))
            <div class="alert alert-success">
              <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
              <strong>Success!</strong> {{Session::get("stock_succcess_created")}}
            </div>
        @endif
        <a class="btn btn-primary pull-right" style="margin: 10px 10px 10px 10px;" href="{{ action('CustomerController@index') }}">Go Back</a></br>
        <h1>Customer </h1>
        <table class="table table-striped table-bordered table-hover">
            <tbody>
            <tr class="bg-info">
            <tr>
                <td>Name</td>
                <td><?php echo ($customer['name']); ?></td>
            </tr>
            <tr>
                <td>Cust Number</td>
                <td><?php echo ($customer['cust_number']); ?></td>
            </tr>
            <tr>
                <td>Address</td>
                <td><?php echo ($customer['address']); ?></td>
            </tr>
            <tr>
                <td>City </td>
                <td><?php echo ($customer['city']); ?></td>
            </tr>
            <tr>
                <td>State</td>
                <td><?php echo ($customer['state']); ?></td>
            </tr>
            <tr>
                <td>Zip </td>
                <td><?php echo ($customer['zip']); ?></td>
            </tr>
            <tr>
                <td>Home Phone</td>
                <td><?php echo ($customer['home_phone']); ?></td>
            </tr>
            <tr>
                <td>Cell Phone</td>
                <td><?php echo ($customer['cell_phone']); ?></td>
            </tr>


            </tbody>
        </table>

        <!-- A table that shows all the stocks relating to the selected customer. -->
        <h2>{{$customer['name']}}'s Stocks</h2>
        <a class="btn btn-success" style="margin: 10px 10px 10px 10px;" href="{{action('StockController@create')}}" class="btn btn-success">Create Stock</a>
        <table class="table table-striped table-bordered table-hover">
        <thead>
        <tr class="bg-info">
            <th>Symbol</th>
            <th>Name</th>
            <th>Shares</th>
            <th>Purchase price</th>
            <th>Purchase Date</th>
            <th>Latest Stock Price</th>
            <th>Total Stock Value</th>
            <th>Latest Stock Value</th>
            <th>Gain Or Loss</th>
            <?php $TotalStockValue = 0; $TotalInvestValue = 0; $TotalGainorLoss = 0; $TotalInvestProfit = 0;?>
            <th colspan="3">Actions</th>
        </tr>
        </thead>
        <tbody>
        <!-- A foreach statement that selects all the stocks relating to the selected customer. -->        
        @foreach ($customer->stocks as $stock)
            <tr>
                <td>{{ $stock->symbol }}</td>
                <td>{{ $stock->name }}</td>
                <td>{{ $stock->shares }}</td>
                <td>{{ $stock->purchase_price }}$</td>
                <td>{{ $stock->purchased }}</td>
                <?php $StockValue = floatval($stock->purchase_price) * floatval($stock->shares);?>
                <td>
                    <?php
                        $options = array(
                            'http' => array(
                                'protocol_version' => '1.0',
                                'method' => 'GET'
                            )
                        );
                        $context = stream_context_create($options);
                        $xmlurl = "http://dev.markitondemand.com/Api/v2/Quote?symbol=".urlencode($stock->symbol);
                        $xml=file_get_contents($xmlurl,false,$context);
                        $xmlr=simplexml_load_string($xml);
                        echo $xmlr->LastPrice;   
                    ?>$                   
                </td>
                <?php $LatestStockValue = floatval($xmlr->LastPrice) * floatval($stock->shares);
                      $GainorLoss = round($LatestStockValue - $StockValue,2);
                      $TotalGainorLoss =  round($TotalGainorLoss + $GainorLoss,2);?>
                <?php $TotalStockValue = $TotalStockValue + $LatestStockValue; ?>                  
                <td>{{ $StockValue }}$</td>
                <td>{{ $LatestStockValue }}$</td>
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

        <!-- A table that shows all the Investments relating to the selected customer. -->
        <h2>{{$customer['name']}}'s Investments</h2>
        <a class="btn btn-success" style="margin: 10px 10px 10px 10px;" href="{{action('InvestmentController@create')}}" class="btn btn-success">Create Investment</a></br>
        <table class="table table-striped table-bordered table-hover">
            <thead>
            <tr class="bg-info">
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
            <!-- A foreach statement that selects all the investments relating to the selected customer. -->
            @foreach ($customer->investments as $Investment)
                <tr>
                    <td>{{ $Investment->category }}</td>
                    <td>{{ $Investment->description }}</td>
                    <td>{{ $Investment->acquired_value }}$</td>
                    <td>{{ $Investment->acquired_date }}</td>
                    <td>{{ $Investment->recent_value }}$</td>
                    <td>{{ $Investment->recent_date }}</td>
                    <?php $TotalInvestValue += $Investment->recent_value;
                          $TotalInvestProfit += $Investment->recent_value - $Investment->acquired_value; ?>                
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

        <!-- A table that shows the total protfolio values and profits relating to the selected customer. -->
        <h2>{{$customer['name']}}'s Total Portfolio</h2>
        <table class="table table-striped table-bordered table-hover">
            <thead>
                <tr class="bg-info">
                    <th>Todays Date.</th>
                    <th>Todays Total value.</th>
                    <th>Total Profit Value</th>
                </tr>
            </thead>
            <tbody>                
                <tr>
                    <?php $TotalValue = $TotalInvestValue + $TotalStockValue; 
                          $TotalProfit = $TotalInvestProfit + $TotalGainorLoss?>
                    <td><?php echo date('Y/m/d'); echo ','.date('l') ?>
                    </td>
                    <td>{{ $TotalValue }}$</td>
                    <td>{{ $TotalProfit }}$</td>
                </tr>
            </tbody>
        </table>
    </div>
@stop
