@extends('layout')
@section('title','Products')

@section('content')
    <div class="list-products">
        <div class="container">
            <div class="row">
                @foreach($products as $product)
                    @if($product->images->count() != 0)
                        <div class="col-4 mb-4" >
                            <div class="card simulation d-block ">
                                <div class="images d-flex" style="overflow: auto">
                                    @foreach($product->images as $image)
                                        <img class="card-img-top" src="{{ asset('images/'.$image->name) }}" alt="">
                                    @endforeach
                                </div>
                                <div class="card-body" style="overflow: hidden">
                                    <a href="{{route('products.edit',$product->id)}}" class="text-danger fs-4"><i class="float-end ri-edit-2-fill"></i></a>
                                    <div class="info text-center">
                                        <p>
                                            <span class="mt-5">Name:</span>
                                            <span related_to="name">{{ $product->name }}</span>
                                        </p>
                                        <p>
                                            <span>Info:</span>
                                            <span related_to="info">{{ $product->info }}</span>
                                        </p>
                                        <p>
                                            <span>Price:</span>
                                            <span related_to="price">{{ $product->price }}</span>
                                        </p>
                                        <div class="star"></div>
                                        <div class="star"></div>
                                        <div class="star"></div>
                                        <div class="star"></div>
                                        <div style="width: 16px; overflow: hidden; display: inline-block;margin:auto -5px;"><div class="star-half"></div></div>
                                        <a href="{{route('products.edit',$product->id)}}" class="btn m-auto" style="background-color: orange; display: block;"> Buy Now <i class="ri-shopping-cart-fill"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
    </div>

@endsection
