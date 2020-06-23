@extends('layout')

@extends('navigation')

@section('content')
@if (Session::has('cart'))
<!-- <div class="container">
    <div class="title">Shoppingcart</div>
    <div class="row justify-content-md-center">
        <div class="col-md-6">
            <ul class="list-group">
                @foreach ($products as $product)
                <li class="list-group-item">
                    <span class="badge">{{ $product['quantity'] }}</span>
                    <strong>{{ $product['item']['title'] }}</strong>
                    <span class="label label-success">{{ $product['price'] }}</span>
                    <div class="btn-group">
                        <button type="button" class="btn btn-primary btn-xs dropdown-toggle" data-toggle="dropdown">
                            Action <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu">
                            <li>
                                <a href="{{ route('product.increaseByOne', ['id' => $product['item']['id']]) }}">
                                    Increase by 1</a>
                            </li>
                            <li>
                                <a href="{{ route('product.reduceByOne', ['id' => $product['item']['id']]) }}">
                                    Reduce by 1</a>
                            </li>
                            <li>
                                <a href="{{ route('product.remove', ['id' => $product['item']['id']]) }}">
                                    Reduce all</a>
                            </li>
                        </ul>
                    </div>
                </li>
                @endforeach
            </ul>
        </div>
    </div>
    <div class="row justify-content-md-center">
        <div class="col-md-6">
            <strong>Total: {{ $totalPrice }}</strong>
        </div>
    </div>
    <hr>
    <div class="row justify-content-md-center">
        <div class="col-md-6">
            <a href="{{ route('checkout') }}" type="button" class="btn btn-succes">Checkout</a>
        </div>
    </div>
</div> -->

<div class="container">
    <div class="title">Shoppingcart</div>
    <div class="row">
        <div class="col-xs-8">
            <div class="panel panel-info">
                <div class="panel-body">
                    @foreach ($products as $product)
                    <div class="row">
                        <div class="col-xs-2"><img class="img-responsive" src="http://placehold.it/100x70">
                        </div>
                        <div class="col-xs-4">
                            <h4 class="product-name"><strong>{{ $product['item']['title'] }}</strong></h4>
                            <div class="buttons" style="width: 300px;">
                                <a class="btn icon-btn btn-success"
                                    href="{{ route('product.increaseByOne', ['id' => $product['item']['id']]) }}"><span
                                        class="glyphicon btn-glyphicon glyphicon-plus img-circle text-success"></span>Add
                                    1</a>
                                <a class="btn icon-btn btn-warning"
                                    href="{{ route('product.reduceByOne', ['id' => $product['item']['id']]) }}"><span
                                        class="glyphicon btn-glyphicon glyphicon-minus img-circle text-warning"></span>Remove
                                    1</a>
                                <a class="btn icon-btn btn-danger"
                                    href="{{ route('product.remove', ['id' => $product['item']['id']]) }}"><span
                                        class="glyphicon btn-glyphicon glyphicon-trash img-circle text-danger"></span>Delete</a>
                            </div>
                        </div>
                        <div class="col-xs-6">
                            <div class="col-xs-6 text-right">
                                <h4><strong>{{ $product['price'] }}</strong></h4>
                            </div>
                        </div>
                    </div>
                    <hr>
                    @endforeach
                    <div class="panel-footer">
                        <div class="row text-center">
                            <div class="col-xs-9">
                                <h4 class="text-right">Total <strong>€ {{ $totalPrice }}</strong></h4>
                            </div>
                            <div class="col-xs-3">
                                <a href="{{ route('checkout') }}">
                                    <button type="button" class="btn btn-success btn-block">
                                        Checkout
                                    </button>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@else
<div class="container">
    <div class="row justify-content-md-center">
        <div class="col-md-6">
            <h2>No items in cart!</h2>
        </div>
    </div>
</div>
@endif
@stop

@extends('footer')