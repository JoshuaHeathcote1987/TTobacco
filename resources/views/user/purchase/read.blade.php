@extends('layouts.app')

@section('title', 'items')

@section('content')

<div class="container py-4">

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="home">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Purchases</li>
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
    @foreach($items->chunk(3) as $chunk)
        @foreach($chunk as $item)
            <div class="col-lg-4 col-md-6 col-sm-12">
                <div class="card mb-3 px-3 py-3 shadow ">
                    <img src="{{ asset('storage/img/product/'.$item->img) }}" class="mx-auto img-thumbnail shadow-sm" style="width: 100%; height: 300px;" alt="...">
                    <div class="card-body">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <th scope="row">Item</th>
                                    <td>{{ $item->name }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Amount</th>
                                    <td>{{ $item->amount }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Weight g</th>
                                    <td>{{ $item->amount * $item->gram}}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Price</th>
                                    <td>&pound;{{ $item->amount * $item->price}}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Bought On</th>
                                    <td>{{ $item->created_at }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        @endforeach
    @endforeach  
    </div>
</div>

@endsection