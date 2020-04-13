@extends('layouts.app')
 
@section('content')

@if(auth()->check())
    @if(auth()->user()->is_admin == 1)
        @include('admin.home')
    @elseif(auth()->user()->is_admin == 0)
        @include('user.home')
    @endif
@else 
    <div class="container mt-5">
        <div class="alert alert-danger" role="alert">
            Your session has timed out - <a href="login">log back in</a>.
        </div>
    </div>
@endif

@endsection