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
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <div class="card-tools">
                    <form action="{{route('admin.orders.index')}}" class="input-group input-group-sm"
                        style="width: 300px;">
                        <input type="text" name="search" class="form-control float-right" placeholder="Search">
                        <div class="input-group-append">
                            <button type="submit" class="btn btn-default">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </form>
                </div>
                <a href="{{route('admin.orders.create')}}">
                    <button class="btn btn-primary btn-create ">
                        <i class="fa fa-plus"></i>
                    </button>
                </a>
            </div>

            <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                    <thead>
                        <tr>
                            <th style="width: 10px">STT</th>
                            <th>User</th>
                            <th>Name</th>
                            <th>Quantity</th>
                            <th>Status</th>
                            <th>Note</th>
                            <th>Total_fee</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach( $orders as $order)
                        <tr>
                            <td>{{$loop->iteration + ($orders->currentPage() -  1) * 20}}.</td>
                            <td>{{ isset($order->user) ? $order->user->name : ''}}</td>
                            <td>{{$order->name}}</td>
                            <td>{{$order->quantity}}</td>
                            <td>{{$status[$order->status]}}</td>
                            <td>{{$order->note}}</td>
                            <td>${{$order->total_fee}}</td>
                            <td style="width:30px">
                                <button class="btn btn-danger btn-delete"
                                    data-link="{{ route('admin.orders.destroy' , $order->id) }}">Delete</button>
                                <a href="{{ route('admin.orders.edit' , $order->id) }}">
                                    <button class="btn btn-primary btn-edit">Edit</button>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <form id="form-delete" action="{{ route('admin.orders.destroy' , $order->id) }}" method="POST">
                    @method('delete')
                    @csrf
                    <button type="submit" class="btn btn-danger btn-destroy d-none">Delete</button>
                </form>
            </div>

            <div class="card-footer clearfix">
                <ul class="pagination pagination-sm m-0 float-right">
                    {{ $orders->links('vendor.pagination.bootstrap-4')}}
                </ul>
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
$(function() {
    $('.btn-delete').click(function() {
        var urlDelete = $(this).data('link');
        console.log(urlDelete);

        $('#form-delete').attr('action', urlDelete);

        if (confirm('Are you sure delete {{ $order->name}} ?')) {
            $('.btn-destroy').click();
        }
    });
});
</script>
@stop