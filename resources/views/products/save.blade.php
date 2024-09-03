@extends('layout')
@section('title','Product | Create')

@section('content')
    <div class="create-product">
        <h2 class="text-center">
            Create Product
        </h2>

        <div class="container">
            @if(session('success'))
                <p class="alert alert-success">{{session('success')}}</p>
            @endif
            <div class="row">
                <div class="col-lg-6 mb-2">
                    <form action="{{route('products.store')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-2">
                            <label for="">Name</label>
                            <input type="text" class="form-control simulated" name="name" required>
                        </div>
                        <div class="mb-2">
                            <label for="">Info</label>
                            <textarea class="form-control simulated" name="info" required></textarea>
                        </div>
                        <div class="mb-2">
                            <label for="">Price</label>
                            <input type="number" class="form-control simulated" name="price" required>
                        </div>
                        <div class="mb-2">
                            <label for="">Images</label>
                            <input type="file" class="form-control simulated" name="images[]" accept="image/*" multiple required>
                        </div>
                        <input type="submit" class="form-control btn btn-success">
                    </form>
                </div>
                <div class="col-lg-6 mb-2 mt-3">
                    <div class="simulation d-block">

                        <div class="images d-flex">

                        </div>

                        <div class="info">
                            <p>
                                <span>Name:</span>
                                <span related_to="name"></span>
                            </p>
                            <p>
                                <span>Info:</span>
                                <span related_to="info"></span>
                            </p>
                            <p>
                                <span>Price:</span>
                                <span related_to="price"></span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
