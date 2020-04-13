@extends('layouts.app')

@section('title', 'User Purchase')

@section('content')

<div class="container py-4">

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/read-user/{{ $items['user_id'] }}">Back</a></li>
            <li class="breadcrumb-item active" aria-current="page">Users Purchase</li>
        </ol>
    </nav>

    <div class="row">
    @foreach($items['items']->chunk(3) as $chunk)
        @foreach($chunk as $item)
            <div class="col-lg-4 col-md-6 col-sm-12">
                <div class="card mb-3 px-3 py-3 shadow">
                    <img src="{{ asset('storage/img/product/'.$item->img) }}" class="mx-auto img-thumbnail shadow-sm" style="width: 100%; height: 300px;" alt="...">
                    <div class="card-body">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <th scope="row">Item</th>
                                    <td>{{ $item->name }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Address</th>
                                    <td>{{ $item->address }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Address 2</th>
                                    <td>{{ $item->address_2 }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Country</th>
                                    <td>{{ $item->country }}</td>
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