@extends('layouts.app')

@section('content')
<div class="row justify-content-center mt-3">
    <div class="col-md-12">

        @session('success')
            <div class="alert alert-success" role="alert">
                {{ $value }}
            </div>
        @endsession

        <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <span>Books</span>
        </div>

        <div class="card-body">
            <a href="{{ route('products.create') }}" class="btn btn-success btn-sm my-2">
                <i class="bi bi-plus-circle"></i> Add New Product
            </a>

            
        </div>