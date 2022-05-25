@extends('adminlte::page')

@section('title', 'Admin | Create Category')

@section('content_header')
<h1>Create Category</h1>
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
        <h3 class="card-title">Add Category</h3>
    </div>
    <form action="{{ route('admin.categories.store') }}" method="POST">
        @csrf
        <div class="card-body">
            <div class="form-group">
                <label for="InputName">Name<span class="text-danger">*</span></label>
                <input type="text" name="name" class="form-control" id="InputName" placeholder="Name"
                    value="{{ old('name')}}">
                @error('name')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>
</div>
@stop

@section('css')
@stop

@section('js')
<script>
</script>
@stop