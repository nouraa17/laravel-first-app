@extends('layout')
@section('title','Contact Us')
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
            <form method="post" action="{{route('contact.submit')}}">
                @csrf
                <div class="mb-3">
                    <label>Username</label>
                    <input class="form-control" name="username" value="{{old('username')}}">
                    @error('username')
                    there is error in username
                    @enderror
                </div>
                <div class="mb-3">
                    <label>Title</label>
                    <input class="form-control" name="title" value="{{old('title')}}">
                </div>
                <div class="mb-3">
                    <label>Message</label>
                    <textarea class="form-control" name="message">{{old('message')}}</textarea>
                </div>
                <input type="submit" class="btn btn-success">
            </form>
        </div>
    </div>

@endsection
