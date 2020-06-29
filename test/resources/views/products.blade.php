@extends('layout')

@extends('navigation')

@section('content')
<div class="container">
    <div class="title">Podcasts</div>

    <style>
    .test {
        height: 260px;
        margin: 0px;
    }

    .bottom-align-text {
        position: absolute;
        bottom: 0;
    }

    .b-m-15 {
        margin-bottom: 15px;
    }
    </style>

    <div class="row" style="float: none; margin: 0 auto;">
        @foreach ($products as $product)
        <a class="col-md-3 img-thumbnail test" href="/products/{{ $product->id }}"
            style="background-image: url('{{ $product->image_link }}'); background-size: 283px 283px;">
            <!-- <h3>{{ $product->title }}</h3> -->
            <!-- <p>{{ $product->description }}</p> -->

            <div class="clearfix bottom-align-text b-m-15">
                <p style="color: white; font-size: 24px;">€{{ $product->price }}</p>
                <!-- <a href="{{ route('product.addToCart', ['id' => $product->id]) }}" class="btn btn-primary pull-left"
                    role="button">Add to cart</a>-->
            </div>
        </a>
        @endforeach
    </div>
</div>
@stop

@extends('footer')