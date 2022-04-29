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
<div class="card">
    <div class="card-body">
        <table class="table table-bordered">
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
                    <td>{{$user->address}}</td>
                    <td>{{$user->phone}}</td>
                    <td style="width:30px">
                        <button class="btn btn-danger btn-delete"
                            data-link="{{ route('admin.users.destroy' , $user->id) }}">Delete</button>
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