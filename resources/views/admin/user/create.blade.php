@extends('layouts.app')
 
@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <div class="font-weight-bold" style="font-size: 1em;">
                        Create User
                        <a href="{{ url('read-users') }}" class="btn btn-dark float-right ml-2">Back</a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <img class="img-thumbnail mx-left d-block" style="" src="{{ asset('storage/user.png') }}">
                        </div>
                        <div class="col">
                            <form method="POST" action="/store-user">
                                @csrf
                                <div class="form-group">
                                    <label>Name</label>
                                    <input name="name" type="" class="form-control" placeholder="Enter name">
                                </div>
                                <div class="form-group">
                                    <label>Email Address</label>
                                    <input name="email" type="email" class="form-control" placeholder="Enter email">
                                </div>
                                <div class="form-group">
                                    <label>Password</label>
                                    <input name="password" class="form-control" placeholder="Enter password">
                                </div>
                                <div class="form-group">
                                    <label for="exampleFormControlSelect1">Admin</label>
                                    <select name="is_admin" class="form-control">
                                    <option>0</option>
                                    <option>1</option>
                                    </select>
                                    <small class="form-text text-muted">Select 0 for user and 1 for admin level status.</small>
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