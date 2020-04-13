@extends('layouts.app')
 
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <div class="font-weight-bold" style="font-size: 1em;">
                        Create Order
                        <a href="{{ url('read-orders') }}" class="btn btn-dark float-right ml-2">Back</a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <img class="img-thumbnail mx-left d-block" style="" src="{{ URL::asset('img/order.png') }}">
                        </div>
                        <div class="col">
                            <form method="POST" action="/store-order">
                                @csrf
                                <div class="form-group">
                                    <label for="exampleFormControlSelect1">User</label>
                                    <select name="user" class="form-control">
                                    @foreach($data['users'] as $user)
                                    <option>{{ $user->id }}</option>
                                    @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleFormControlSelect1">Product</label>
                                    <select name="product" class="form-control">
                                    @foreach($data['products'] as $product)
                                    <option>{{ $product->id }}</option>
                                    @endforeach
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-primary float-right">Create</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection