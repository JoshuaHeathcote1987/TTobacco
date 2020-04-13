@extends('layouts.app')
 
@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Users</div>
                <div class="card-body">
                    <div class="mb-3">
                        <a href="create-user" class="btn btn-success w-25">Create</a>
                        <a href="home" class="btn btn-dark w-25">Back</a>
                        <form class="float-right" method="POST" action="/search-user">
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
                            <th scope="col">Email</th>
                            <th scope="col">Admin</th>
                            <th scope="col">Options</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $user)  
                                <tr>
                                <th scope="row">{{ $user->id }}</th>
                                <td><a href="read-user/{{ $user->id}}">{{ $user->name }}</a></td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    @if($user->is_admin)
                                        Yes
                                    @else
                                        No
                                    @endif
                                </td>
                                <td class="float-right">
                                    <a href="{{ url('edit-user/'.$user->id) }}" class="btn btn-warning" style="width: 6em;"><i class="fas fa-pen"></i></a>
                                    <a href="{{ url('delete-user/'.$user->id ) }}" class="btn btn-danger" style="width: 6em;"><i class="fas fa-trash"></i></a>
                                </td>
                                </tr>
                            @endforeach                            
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="mt-3">{{ $users->links() }}</div>
        </div>
    </div>
</div>
@endsection