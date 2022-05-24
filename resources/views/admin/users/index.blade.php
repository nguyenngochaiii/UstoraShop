@extends('adminlte::page')

@section('title', 'Admin | User list')

@section('content_header')
<h1>User list</h1>
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
                    <form action="{{route('admin.users.index')}}" class="input-group input-group-sm"
                        style="width: 300px;">
                        <input type="text" name="search" class="form-control float-right" placeholder="Search">
                        <div class="input-group-append">
                            <button type="submit" class="btn btn-default">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </form>
                </div>
                <a href="{{route('admin.users.create')}}">
                    <button class="btn btn-primary btn-create ">
                        Create
                    </button>
                </a>
            </div>

            <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                    <thead>
                        <tr>
                            <th style="width: 10px">STT</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Address</th>
                            <th>Phone</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach( $users as $user)
                        <tr>
                            <td>{{$loop->iteration + ($users->currentPage() -  1) * 20}}.</td>
                            <td>{{$user->name}}</td>
                            <td>${{$user->email}}</td>
                            <td>{{$user->streetAddress}}, {{$user->city}}, {{$user->country}}</td>
                            <td>{{$user->phone}}</td>
                            <td style="width:30px">
                                <button class="btn btn-danger btn-delete"
                                    data-link="{{ route('admin.users.destroy' , $user->id) }}">Delete</button>
                                <a href="{{ route('admin.users.edit' , $user->id) }}">
                                    <button class="btn btn-primary btn-edit">Edit</button>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <form id="form-delete" action="{{ route('admin.users.destroy' , $user->id) }}" method="POST">
                    @method('delete')
                    @csrf
                    <button type="submit" class="btn btn-danger btn-destroy d-none">Delete</button>
                </form>
            </div>

            <div class="card-footer clearfix">
                <ul class="pagination pagination-sm m-0 float-right">
                    {{ $users->links('vendor.pagination.bootstrap-4')}}
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
    $('.btn-delete').click(
        function() {
            var urlDelete = $(this).data('link');
            console.log(urlDelete);

            $('#form-delete').attr('action', urlDelete);

            if (confirm('Are you sure delete {{ $user->name}} ?')) {
                $('.btn-destroy').click();
            }
        }
    )
});
</script>
@stop