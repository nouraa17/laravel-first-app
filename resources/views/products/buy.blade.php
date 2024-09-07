@extends('layout')
@section('title','Products')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-8 m-auto">
                @if(session('success'))
                    <p class="alert alert-success">{{session('success')}}</p>
                @endif
                <h1 class="mt-4">Buy {{ $product->name }}</h1>

                <form action="{{ route('products.checkout', $product->id) }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="quantity" class="form-label">Select Quantity</label>
                        <input type="number" name="quantity" id="quantity" class="form-control" min="1" max="100" value="1" required>
                    </div>

                    <div class="mb-3">
                        <p>Price per item: {{ $product->price }}</p>
                        <p>Total Price: <span id="total-price" data-price="{{ $product->price }}">{{ $product->price }}</span></p>
                    </div>

                    <button type="submit" class="btn btn-success">Proceed to Checkout</button>
                </form>


            </div>
        </div>
    </div>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var quantityInput = document.getElementById('quantity');
        var totalPriceElement = document.getElementById('total-price');
        var pricePerItem = totalPriceElement.getAttribute('data-price');

        quantityInput.addEventListener('input', function() {
            var quantity = this.value;
            var totalPrice = quantity * pricePerItem;
            totalPriceElement.textContent = totalPrice.toFixed(2);
        });
    });
</script>
@endsection
