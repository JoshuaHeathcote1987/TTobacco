@extends('layouts.app')
 
@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Shipping</div>
                <div class="card-body">
                    <div class="mb-3">
                        <a href="home" class="btn btn-dark w-25">Back</a>
                        <form class="float-right" method="POST" action="/search-shipping">
                            @csrf   
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Search</span>
                                </div>
                            <input class="form-control mr-3" name="search">
                            <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>  
                    </div>
                    <table class="table table-hover">
                        <thead class="thead-dark">
                            <tr>
                            <th scope="col">#</th>
                            <th scope="col">user_id</th>
                            <th scope="col">address</th>
                            <th scope="col">created_at</th>
                            <th scope="col">Options</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($shippings as $shipping)  
                                <tr>
                                <td>{{ $shipping->id }}</td>
                                <td>{{ $shipping->user_id }}</td>
                                <td>{{ $shipping->address }}</td>
                                <td>{{ $shipping->created_at }}</td>
                                <td class="float-right">
                                    <a href="delete-shipping/{{ $shipping->id }}" class="btn btn-danger">Delete</a>
                                </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection