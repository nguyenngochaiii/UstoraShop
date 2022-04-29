@extends('adminlte::page')

@section('title', 'Admin | Edit User')

@section('content_header')
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
<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">Edit User</h3>
    </div>
    <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
        @method('PUT')
        @csrf
        <div class="card-body">
            <div class="form-group">
                <label for="InputName">Name</label>
                <input type="text" name="name" class="form-control" id="InputName" placeholder="Name"
                    value=" {{ $user->name }}">
                @error('name')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="InputUserName">UserName</label>
                <input type="text" name="username" class="form-control" id="InputUserName" placeholder="username"
                    value=" {{ $user->username }}">
                @error('password')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="InputPassWord">Password</label>
                <input type="text" name="password" class="form-control" id="InputPassWord" placeholder="password"
                    value=" {{ $user->password }}">
                @error('password')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="InputEmail">Email<span class="text-danger">*</span></label>
                <input type="text" name="email" class="form-control" id="InputEmail" placeholder="email"
                    value="{{ $user->price }}">
                @error('email')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="InputAddress">Address</label>
                <input type="text" name="address" class="form-control" id="InputAddress" placeholder="address"
                    value=" {{ $user->address }}">
                @error('address')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="InputSex">sex</label>
                <input type="text" name="sex" class="form-control" id="InputSex" placeholder="sex"
                    value=" {{ $user->sex }}">
                @error('sex')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="InputDOB">Date of Birth</label>
                <input type="text" name="dob" class="form-control" id="InputDOB" placeholder="dob"
                    value=" {{ $user->date_of_birth }}">
                @error('dob')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Update</button>
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