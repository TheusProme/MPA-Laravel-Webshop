@extends('layout')

@extends('navigation')

@section('content')
<div class="container">
    <div class="container">
        <div class="row justify-content-md-center">
            @foreach ($products as $product)
            <h3><strong>{{ $product->title }}</strong></h3>
            <div class="col-md-auto"><textarea class="description">{{ $product->description }}</textarea></div>
            <!-- <span>Items left: {{ $product->quantity }}</span> -->
            <p>€{{ $product->price }}</p>
            <a href="{{ route('product.addToCart', ['id' => $product->id]) }}" class="btn btn-primary pull-left"
                role="button">Add to cart</a>

            <br>
            <br>
            @foreach($categories as $category)
            <a href="/categories/{{ $category->id }}">{{ $category->title }}</a>
            @endforeach
            @endforeach
        </div>
    </div>
</div>

<style>
textarea.description {
    width: 50%;
    height: 70%;
    border: none;
}
</style>
@stop

@extends('footer')