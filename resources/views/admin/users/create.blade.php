@extends('adminlte::page')

@section('title', 'Admin | Create User')

@section('content_header')
<h1>Create User</h1>
@if (session('error'))
<div class="alert alert-warning">
    {{session('error')}}
</div>
@endif
@if (session('status'))
<div class="alert alert-success">
    {{session('status')}}
</div>
@endif
@stop

@section('content')
<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">Add User</h3>
    </div>
    <form action="{{ route('admin.users.store') }}" method="POST">
        @csrf
        <div class="card-body">
            <div class="form-group">
                <label for="InputName">Name<span class="text-danger">*</span></label>
                <input type="text" name="name" class="form-control" id="InputName" value="{{ old('name')}}">
            </div>
            <div class="form-group">
                <label for="InputUserName">Username<span class="text-danger">*</span></label>
                <input type="text" name="username" class="form-control" id="InputUserName" value="{{ old('username')}}">
            </div>
            <div class="form-group">
                <label for="InputPassword">Password<span class="text-danger">*</span></label>
                <input type="text" name="password" class="form-control" id="InputPassword" value="{{ old('password')}}">
            </div>
            <div class="form-group">
                <label for="InputPhone">Phone<span class="text-danger">*</span></label>
                <input type="text" name="phone" class="form-control" id="InputPhone" value="{{ old('phone')}}">
            </div>
            <div class="form-group">
                <label for="InputEmail">Email<span class="text-danger">*</span></label>
                <input type="text" name="email" class="form-control" id="InputEmail" value="{{ old('email')}}">
            </div>
            <div class="form-group">
                <label for="InputAddress">Address<span class="text-danger">*</span></label>
                <input type="text" name="address" class="form-control" id="InputAddress" value=" {{ old('address') }}">
            </div>
            <div class="form-group">
                <label for="InputSex">Sex<span class="text-danger">*</span></label>
                <input type="text" name="sex" class="form-control" id="InputSex" value=" {{ old('sex') }}">
            </div>
            <div class="form-group">
                <label for="InputDOB">Date of Birth<span class="text-danger">*</span></label>
                <input type="text" name="date_of_birth" class="form-control" id="InputDOB"
                    value=" {{ old('date_of_birth') }}">
            </div>
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>
</div>
@stop

@section('css')
<!-- <link rel="stylesheet" href="/css/admin_custom.css"> -->
@stop

@section('js')
<script>
console.log('Hi!');
</script>
@stop