@extends('layouts.app')

@section('title', 'User Cart')

@section('content')

<div class="container py-4">

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/home">Home</a></li>
            <li class="breadcrumb-item active"><a href="/view-products">Products</a></li>
            <li class="breadcrumb-item active" aria-current="page">Cart</li>
        </ol>
    </nav>

    

    @if (Session::has('empty-status'))
        <div class="alert alert-warning alert-dismissible fade show text-justify d-none d-md-block" role="alert">
            {!! Session::get('empty-status') !!}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <a href="/user/checkout" class="btn btn-success shadow-sm mb-4">Checkout</a>
    <a href="/user/remove-all" class="btn btn-danger shadow-sm mb-4">Remove All</a>

    <div class="row">
    @foreach($products->chunk(3) as $chunk)
        @foreach($chunk as $product)
            <div class="col-lg-4 col-md-6 col-sm-12">
                <div class="card mb-3 px-3 py-3 shadow">
                    <img src="{{ asset('storage/img/product/'.$product->img) }}" class="mx-auto img-thumbnail shadow-sm" style="width: 100%; height: 300px;" alt="...">
                    <div class="card-body">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <th scope="row">product</th>
                                    <td>{{ $product->name }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Weight </th>
                                    <td>{{ $product->gram }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Amount</th>
                                    <td>{{ $product->amount }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Price</th>
                                    <td>&pound;{{ $product->price * $product->amount }}</td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="m-auto">
                            <a href="/user/delete-item/{{ $product->id }}" class="btn btn-danger btn-block shadow-sm">Remove</a>
                        </div> 
                    </div>
                </div>
            </div>
        @endforeach
    @endforeach  
    </div>
</div>

@endsection