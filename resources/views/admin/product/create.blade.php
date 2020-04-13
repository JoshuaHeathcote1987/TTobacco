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
                            <img class="img-thumbnail mx-left d-block" style="" src="{{ asset('storage/product.png') }}">
                        </div>
                        <div class="col">
                            <form method="POST" action="/store-product" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label>Name</label>
                                    <input name="name" type="" class="form-control" placeholder="Enter name" required>
                                </div>
                                <div class="form-group">
                                    <label for="exampleFormControlTextarea1">Description</label>
                                    <textarea name="description" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                                </div>
                                <div class="form-group">
                                    <label>Price</label>
                                    <input name="price" class="form-control" placeholder="Enter price" required>
                                </div>
                                <div class="form-group">
                                    <label for="exampleFormControlSelect1">Grams</label>
                                    <select name="kilogram" class="form-control">
                                    <option>25</option>
                                    <option>50</option>
                                    <option>100</option>
                                    <option>200</option>
                                    <option>500</option>
                                    <option>1000</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleFormControlSelect1">Type</label>
                                    <select name="type" class="form-control">
                                    <option>Tobacco</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleFormControlFile1">Image</label>
                                    <input name="image" type="file" class="form-control-file" accept="image/*">
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