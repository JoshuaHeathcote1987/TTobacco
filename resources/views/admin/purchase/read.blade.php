@extends('layouts.app')
 
@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Purchases</div>
                <div class="card-body">
                    <div class="mb-3">
                        <a href="home" class="btn btn-dark w-25">Back</a>
                        <form class="float-right" method="POST" action="/search-purchase">
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
                            <th scope="col">Item Name</th>
                            <th scope="col">Address</th>
                            <th scope="col">Amount</th>
                            <th scope="col">Date</th>
                            <th scope="col">Sent</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($purchases as $purchase)  
                                <tr>
                                <td>{{ $purchase->name }}</td>
                                <td>{{ $purchase->address }}, {{ $purchase->address_2 }}, {{ $purchase->country }}, {{ $purchase->zip }}</td>
                                <td>{{ $purchase->amount }}</td>
                                <td>{{ $purchase->created_at }}</td>
                                <td>
                                    <div class="form-check">
                                        <form action="/update-sent/{{ $purchase->id }}" method="POST">
                                            @csrf
                                            @if ($purchase->sent == 0)
                                                <input onChange="this.form.submit()" class="form-check-input" name="checkbox" id="checkbox" value="1" type="checkbox"/>
                                            @elseif ($purchase->sent == 1)
                                                <input onChange="this.form.submit()" class="form-check-input" name="checkbox" id="checkbox" value="0" type="checkbox" checked/>
                                            @endif
                                        </form>
                                    </div>
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