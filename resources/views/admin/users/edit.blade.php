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
    <form action="{{ route('admin.users.update', $user->id) }}" method="POST" enctype="multipart/form-data">
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
                @error('username')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="InputPassword">Password</label>
                <input type="text" name="password" class="form-control" id="InputPassword" placeholder="password"
                    value=" {{ $user->password }}">
                @error('password')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="InputPhone">Phone<span class="text-danger">*</span></label>
                <input type="text" name="phone" class="form-control" id="InputPhone" placeholder="phone"
                    value="{{ $user->phone }}">
                @error('phone')
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
                <label for="InputCountry">Country</label>
                <input type="text" name="country" class="form-control" id="InputCountry" placeholder="country"
                    value=" {{ $user->country }}">
                @error('country')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="InputStreetAddress">streetAddress</label>
                <input type="text" name="streetAddress" class="form-control" id="InputStreetAddress"
                    placeholder="streetAddress" value=" {{ $user->streetAddress }}">
                @error('streetAddress')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="InputCity">City</label>
                <input type="text" name="city" class="form-control" id="InputCity" placeholder="city"
                    value=" {{ $user->city }}">
                @error('city')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="InputPostCode">postCode</label>
                <input type="text" name="postcode" class="form-control" id="InputPostCode" placeholder="address"
                    value=" {{ $user->postCode }}">
                @error('postCode')
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
                <label for="InputAvatar">Avatar</label>
                <br>
                <img src="{{ url('public/Image/'.$user->avatar) }}" style="height: 100px; width: 150px;">
                <input type="file" name="avatar" class="form-control" id="InputAvatar" value=" {{ $user->avatar }}">
                @error('avatar')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="Input_date_of_birth">Date of Birth</label>
                <input type="text" name="dob" class="form-control" id="Input_date_of_birth" placeholder="dob"
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