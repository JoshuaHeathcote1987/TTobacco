@extends('layouts.app')
 
@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card mb-3">
                <div class="card-header">
                    <div class="font-weight-bold" style="font-size: 1em;">
                        {{ $users->name }}
                        <a href="{{ url('read-users') }}" class="btn btn-dark float-right ml-2">Back</a>
                        <a href="{{ url('edit-user/'.$users->id) }}" class="btn btn-warning float-right ml-2">Update</a>
                        <a href="{{ url('delete-user/'.$users->id) }}" class="btn btn-danger float-right ml-2">Delete</a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <img class="img-thumbnail mx-left d-block" style="" src="{{ URL::asset('storage/user.png') }}">
                        </div>
                        <div class="col">
                            <p><b>Email:</b> {{ $users->email }}</p>
                            <p><b>Admin:</b>
                                @if ($users->is_admin === 1)
                                    Yes
                                @else
                                    No
                                @endif
                            </p>
                            <p><b>Created at:</b> {{ $users->created_at }}</p>
                            <p><b>Updated at:</b> {{ $users->updated_at }}</p>
                        </div>
                    </div>
                </div>
            </div>



            <div class="card mb-3">
                <div class="card-header font-weight-bold">User Dashboard</div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-sm">
                            <a href="user-cart/{{ $users->id }}">
                                <div class="border text-center p-3">
                                    <i class="fas fa-shopping-cart fa-4x"></i>
                                </div>
                            </a>
                        </div>
                        <div class="col-sm">
                            <a href="user-purchase/{{ $users->id }}">
                                <div class="border text-center p-3">
                                    <i class="fas fa-money-bill-wave fa-4x"></i>
                                </div>
                            </a>
                        </div>
                        <div class="col-sm">
                            <a href="user-transaction/{{ $users->id }}">
                                <div class="border text-center p-3">
                                    <i class="fab fa-cc-visa fa-4x"></i>
                                </div>
                            </a>
                        </div>
                    </div>
                </div> 
            </div>


        </div>
    </div>
</div>
@endsection