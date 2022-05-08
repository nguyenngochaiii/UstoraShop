@extends('adminlte::page')

@section('title', 'Admin | Order list')

@section('content_header')
<h1>Order list</h1>
@if (session('status'))
<div class="alert alert-success">
    {{session('status')}}
</div>
@endif
@if (session('error'))
<div class="alert alert-warning">
    {{session('error')}}
</div>
@endif
@stop

@section('content')
<div class="card">
    <div class="card-body">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th style="width: 10px">STT</th>
                    <th>User</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Address</th>
                    <th>Quantity</th>
                    <th>Status</th>
                    <th>Note</th>
                    <th>Total_fee</th>
                </tr>
            </thead>
            <tbody>
                @foreach( $orders as $order)
                <tr>
                    <td>{{$loop->iteration + ($orders->currentPage() -  1) * 20}}.</td>
                    <td>{{ isset($order->user) ? $order->user->name : ''}}</td>
                    <td>{{$order->name}}</td>
                    <td>{{$order->email}}</td>
                    <td>{{$order->phone}}</td>
                    <td>{{$order->address}}</td>
                    <td>{{$order->quantity}}</td>
                    <td>{{$status[$order->status]}}</td>
                    <td>{{$order->note}}</td>
                    <td>${{$order->total_fee}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="card-footer clearfix">
        <ul class="pagination pagination-sm m-0 float-right">
            {{ $orders->links('vendor.pagination.bootstrap-4')}}
        </ul>
    </div>
</div>
@stop

@section('css')
<!-- <link rel="stylesheet" href="/css/admin_custom.css"> -->
@stop

@section('js')
<script>
</script>
@stop