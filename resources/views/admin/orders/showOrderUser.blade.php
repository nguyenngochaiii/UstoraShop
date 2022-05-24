@extends('adminlte::page')

@section('title', 'Admin | Order list')

@section('content_header')
<h1>Order list</h1>
@stop

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
            </div>
            <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                    <thead>
                        <tr>
                            <th style="width: 10px">STT</th>
                            <th>Name</th>
                            <th>Price</th>
                            <th>Quantity</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach( $products as $product)
                        <tr>
                            <td>{{$loop->iteration}}.</td>
                            <td>{{$product->name}}</td>
                            <td>${{$product->price}}</td>
                            <td>{{$product->quantity}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
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