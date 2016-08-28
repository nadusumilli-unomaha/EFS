@extends('layouts/app')
@section('content')
    <!-- Going into detail on the investment information of a particular Investment. -->
    <div class="container">
        <h1>{{ $investment->customer->name }}'s {{ $investment->category }} Investment Details</h1>
        <a class="btn btn-primary pull-right" style="margin: 10px 10px 10px 10px;" href="{{ URL::previous() }}">Go Back</a>
            <table class="table table-striped table-bordered table-hover">
                <tbody>
                <tr class="bg-info">
                <tr>
                    <td>Investment Category</td>
                    <td><?php echo ($investment['category']); ?></td>
                </tr>
                <tr>
                    <td>Investment Description</td>
                    <td><?php echo ($investment['description']); ?></td>
                </tr>
                <tr>
                    <td>Acquired Value</td>
                    <td>$<?php echo ($investment['acquired_value']); ?></td>
                </tr>
                <tr>
                    <td>Acquired Date</td>
                    <td><?php echo ($investment['acquired_date']); ?></td>
                </tr>
                <tr>
                    <td>Recent Value</td>
                    <td>$<?php echo ($investment['recent_value']); ?></td>
                </tr>
                <tr>
                    <td>Recent Date</td>
                    <td><?php echo ($investment['recent_date']); ?></td>
                </tr>
                </tbody>
            </table>
    </div>
@stop
