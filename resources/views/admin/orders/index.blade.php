@extends('adminlte::page')

@section('title', 'Admin | Order list')

@section('content_header')
<h1>Product list</h1>
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
                    <th>Product</th>
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
                @foreach( $products as $product)
                <tr>
                    <td>{{$loop->iteration + ($products->currentPage() -  1) * 20}}.</td>
                    <td>{{$product->user->id}}</td>
                    <td>${{$product->price}}</td>
                    <td>{{$product->quantity}}</td>
                    <td>{{$product->user->name}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="card-footer clearfix">
        <ul class="pagination pagination-sm m-0 float-right">
            {{ $products->links('vendor.pagination.bootstrap-4')}}
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