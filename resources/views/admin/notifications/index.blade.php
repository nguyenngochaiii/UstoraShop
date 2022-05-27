@extends('adminlte::page')

@section('title', 'Notifications All')

@section('content_header')
<h1>Notifications</h1>
@stop

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                    <thead>
                        <tr>
                            <th style="width: 10px">STT</th>
                            <th>Content</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach( $notifications as $notification)
                        <tr>
                            <td>{{$loop->iteration + ($notifications->currentPage() -  1) * 12}}.</td>
                            <td>
                                <a style="color: #111;"
                                    href="{{ route('admin.orders.show' , $notification->id)}}">{{$notification->content}}</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="card-footer clearfix">
                <ul class="pagination pagination-sm m-0 float-right">
                    {{ $notifications->links('vendor.pagination.bootstrap-4')}}
                </ul>
            </div>
        </div>
    </div>
</div>
@stop

@section('css')
@stop

@section('js')
@stop