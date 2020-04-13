@extends('layouts.app')
 
@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <div class="font-weight-bold" style="font-size: 1em;">
                        Product Description
                        <a href="{{ url('view-products') }}" class="btn btn-dark float-right ml-2">Back</a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-12 col-md-12 col-lg-6 mb-3">
                            <img class="img-thumbnail mx-left d-block shadow mx-auto" style="width: 100%; height: 300px;" src="{{ asset('storage/img/product/'.$products->img) }}">
                        </div>
                        <div class="col-sm-12 col-md-12 col-lg-6">
                            <form method="POST" action="/create-cart/{{ $products->id }}" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label>Name</label>
                                    <input name="name" type="" class="form-control" placeholder="Enter name" value="{{ $products->name }}" readonly>
                                </div>
                                <div class="form-group">
                                    <label>Price Per Package</label>
                                    <input id="price" name="price" class="form-control" placeholder="Enter price" value="{{ $products->price }}" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="exampleFormControlSelect1">Amount</label>
                                    <select id="amount" name="amount" class="form-control" id="exampleFormControlSelect1">
                                    <option>1</option>
                                    <option>2</option>
                                    <option>3</option>
                                    <option>4</option>
                                    <option>5</option>
                                    <option>6</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Price</label>
                                    <input id="total" name="name" class="form-control" value="{{ $products->price }}" readonly>
                                </div>
                                <button type="submit" class="btn btn-success btn-block"><i class="fas fa-plus fa-3x"></i></button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function(){
        $("#amount").click(function(){
            var amount = $("#amount");
            var price = $("#price");
            var total = amount.val() * price.val();
            $("#total").val(total);
        });
    });
</script>

@endsection

