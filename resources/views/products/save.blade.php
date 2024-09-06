@extends('layout')
@section('title','Product | Save')

@section('content')
    <div class="create-product">
        <h2 class="text-center">
            {{$title}} Product
        </h2>

        <div class="container">
            @if(session('success'))
                <p class="alert alert-success">{{session('success')}}</p>
            @endif
            <div class="row">
                <div class="col-lg-6 mb-2">
                    @if($errors->any())
                        @foreach($errors->all() as $error)
                            <p class="alert alert-danger">{{$error}}</p>
                        @endforeach
                    @endif
                    <form action="{{ route($routeName[0], isset($routeName[1]) ? $routeName[1] : null) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @if($edit)
                            @method('PUT')
{{--                            <input type="hidden" name="_method" value="PUT">--}}
                        @endif
                        <div class="mb-2">
                            <label for="">Name</label>
                            <input type="text" class="form-control simulated" name="name"  @if($edit) value="{{ $product->name }}" @endif required>
                        </div>
                        <div class="mb-2">
                            <label for="">Info</label>
                            <textarea class="form-control simulated" name="info" required>@if($edit) {{ $product->info }} @endif</textarea>
                        </div>
                        <div class="mb-2">
                            <label for="">Price</label>
                            <input type="number" class="form-control simulated" name="price" @if($edit) value="{{ $product->price }}" @endif required>
                        </div>
                        <div class="mb-2">
                            <label for="">Images</label>
                            @if($edit)
                                <div class="form-images d-flex">
                                    @foreach($product->images as $image)
                                        <div class="position-relative">
                                            <a href="/delete?model_name=images&id={{$image->id}}" onclick="return confirm('Are you sure you want to delete this item?');"><i class="ri-delete-bin-2-fill"></i></a>
                                            <img class="m-3" src="{{ asset('images/'.$image->name) }}" alt="">
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                            <input type="file" class="form-control simulated" name="images[]" accept="image/*" multiple @if(!$edit) required @endif>
                        </div>
                        <input type="submit" class="form-control btn btn-success">
                    </form>
                </div>
                <div class="col-lg-4 mb-2 mt-3 m-auto">
                    <h3 class="text-center text-success"><strong>Product preview</strong></h3>
                    <div class="card simulation d-block text-center">
                        <div class="images d-flex" style="overflow: auto">
                            @foreach($product->images as $image)
                                <img class="card-img-top" src="{{ asset('images/'.$image->name) }}" alt="">
                            @endforeach
                        </div>
                        <div class="card-body">
                            <div class="info">
                                <p>
                                    <span>Name:</span>
                                    <span related_to="name">@if($edit) {{ $product->name }} @endif</span>
                                </p>
                                <p>
                                    <span>Info:</span>
                                    <span related_to="info">@if($edit) {{ $product->info }} @endif</span>
                                </p>
                                <p>
                                    <span>Price:</span>
                                    <span related_to="price">@if($edit) {{ $product->price }} @endif</span>
                                </p>
                                <div class="star"></div>
                                <div class="star"></div>
                                <div class="star"></div>
                                <div class="star"></div>
                                <div style="width: 16px; overflow: hidden; display: inline-block;margin:auto -5px;"><div class="star-half"></div></div>
                                <a href="#" class="btn m-auto" style="background-color: orange; display: block;"> Buy Now <i class="ri-shopping-cart-fill"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
