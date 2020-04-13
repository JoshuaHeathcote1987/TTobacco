@extends('layouts.app')

@section('title', 'User Purchase')

@section('content')

<div class="container py-4">

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/read-user/{{ $items['user_id'] }}">Back</a></li>
            <li class="breadcrumb-item active" aria-current="page">Users Transaction</li>
        </ol>
    </nav>

    <div class="row">
    @foreach($items['items']->chunk(3) as $chunk)
        @foreach($chunk as $item)
            <div class="col-lg-4 col-md-6 col-sm-12">
                <div class="card mb-3 px-3 py-3 shadow">
                <i class="fas fa-donate fa-10x mx-auto"></i>
                    <div class="card-body">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <th scope="row">Total</th>
                                    <td>{{ $item->total / 100 }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Created at</th>
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