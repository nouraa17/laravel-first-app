@extends('layout')
@section('title', 'Edit User')
@section('content')
    <div class="contact_us">
        <div class="container">
            @if($errors->any())
                @foreach($errors->all() as $error)
                    <p class="alert alert-danger">{{$error}}</p>
                @endforeach
            @endif
            @if(session('success'))
                <p class="alert alert-success">{{session('success')}}</p>
            @endif
            <form method="post" action="{{route('dashboard.update.user', $user->id)}}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label>Username</label>
                    <input class="form-control" name="username" value="{{ $user->username }}">
                </div>
                <div class="mb-3">
                    <label>Email</label>
                    <input class="form-control" name="email" value="{{ $user->email }}">
                </div>
                <div class="mb-3">
                    <label>Phone</label>
                    <input class="form-control" name="phone" value="{{ $user->phone }}">
                </div>
                <div class="mb-3">
                    <label>Password (leave blank if you don't want to change it)</label>
                    <input class="form-control" type="password" name="password">
                </div>
                <div class="mb-3">
                    <label>Personal Image (leave blank if you don't want to change it)</label>
                    <input class="form-control" name="image" type="file">
                </div>

                <input type="submit" class="btn btn-success" value="Update User">
            </form>
        </div>
    </div>
@endsection
