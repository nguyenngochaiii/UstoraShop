@extends('adminlte::page')

@section('title', 'Admin | Edit Category')

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
        <h3 class="card-title">Edit Category</h3>
    </div>
    <form action="{{ route('admin.categories.update', $category->id) }}" method="POST">
        @method('PUT')
        @csrf
        <div class="card-body">
            <div class="form-group">
                <label for="InputName">Name</label>
                <input type="text" name="name" class="form-control" id="InputName" placeholder="Name"
                    value=" {{ $category->name }}">
                @error('name')
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
@stop

@section('js')
<script>
</script>
@stop