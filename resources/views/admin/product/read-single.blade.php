@extends('layouts.app')
 
@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <div class="font-weight-bold" style="font-size: 1em;">
                        Create Product
                        <a href="{{ url('read-products') }}" class="btn btn-dark float-right ml-2">Back</a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <img class="img-thumbnail mx-left d-block" style="" src="{{ asset('storage/img/product/'.$products->img) }}">
                        </div>
                        <div class="col">
                                <div class="form-group">
                                    <label>Name</label>
                                    <input name="name" type="" class="form-control" placeholder="Enter name" value="{{ $products->name }}" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="exampleFormControlTextarea1">Description</label>
                                    <textarea name="description" class="form-control" id="exampleFormControlTextarea1" rows="3" readonly>{{ $products->description }}</textarea>
                                </div>
                                <div class="form-group">
                                    <label>Price</label>
                                    <input name="price" class="form-control" placeholder="Enter price" value="{{ $products->price }}" readonly>
                                </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection