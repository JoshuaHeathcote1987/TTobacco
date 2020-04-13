@extends('layouts.app')

@section('title', 'Products')

@section('content')

<div class="container py-4">

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="home">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Products</li>
        </ol>
    </nav>

    @if (Session::has('warning-status'))
        <div class="alert alert-warning">
            {!! Session::get('warning-status') !!}
        </div>
        
    @endif

    @if (Session::has('success-status'))
        <div class="alert alert-success">
            {!! Session::get('success-status') !!}
        </div>
    @endif

    
    <div class="row"> 
    @foreach($products->chunk(3) as $chunk)      
        @foreach($chunk as $product)
            <div class="col-lg-4 col-md-6 col-sm-12">
                <div class="card mb-3 px-3 py-3 shadow ">
                    <img src="{{ asset('storage/img/product/'.$product->img) }}" class="mx-auto img-thumbnail shadow-sm" style="width: 100%; height: 300px;" alt="...">
                    <div class="card-body">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <th scope="row">Item</th>
                                    <td>{{ $product->name }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Weight g</th>
                                    <td>{{ $product->gram }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Price</th>
                                    <td>&pound;{{ $product->price}}</td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="m-auto">
                            <a href="/view-product/{{ $product->id }}" class="btn btn-success btn-block shadow-sm">View</a>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    @endforeach
    </div>
</div>

@endsection