@extends('layouts.master_auth')
 
@section('content')
<?php //print_r($products);exit; ?>
    <div class="container">
        <div class="row justify-content-center">
             @foreach($products as $product)
                <div class="col-xs-18 col-sm-6 col-md-3" style="padding:5px;">
                    <div class="thumbnail">
                        <img src="{{ asset('images/'.$product->image ) }}" width="300" height="300">
                        <div class="caption">
                            <h4>{{ $product->title }}</h4>
                            <p>{{ \Illuminate\Support\Str::limit(strtolower($product->description), 50, '...') }}</p>
                            <p><strong>Price: </strong> {{ $product->price }}$</p>
                            <p class="btn-holder">
                            @if(Session::get('username')!="")
                            <a href="{{ url('add-to-cart/'.$product->id) }}" class="btn btn-warning btn-block text-center" role="button">Add to cart</a> 
                            @else
                            <a href="{{route('customer_login')}}" class="btn btn-warning btn-block text-center" role="button">Add to cart</a> 
                            @endif
                            </p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection