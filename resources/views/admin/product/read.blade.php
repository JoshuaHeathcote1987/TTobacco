@extends('layouts.app')
 
@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Products</div>
                <div class="card-body">
                    <div class="mb-3">
                        <a href="create-product" class="btn btn-success w-25">Create</a>
                        <a href="home" class="btn btn-dark w-25">Back</a>
                        <form class="float-right" method="POST" action="/search-product">
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
                            <th scope="col">Name</th>
                            <th scope="col">Grams</th>
                            <th scope="col">Price</th>
                            <th scope="col">Type</th>
                            <th scope="col">Options</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($products as $product)  
                                <tr>
                                <td>{{ $product->id }}</td>
                                <td><a href="read-product/{{ $product->id}}">{{ $product->name }}</a></td>
                                <td>{{ $product->gram }}</td>
                                <td>{{ $product->price }}</td>
                                <td>{{ $product->type }}</td>
                                <td class="float-right">
                                    <a href="edit-product/{{ $product->id }}" class="btn btn-warning">Update</a>
                                    <a href="delete-product/{{ $product->id }}" class="btn btn-danger">Delete</a>
                                </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="mt-3">{{ $products->links() }}</div>
        </div>
    </div>
</div>
@endsection