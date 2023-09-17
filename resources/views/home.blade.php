@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <h2>{{ __('Interesting Products') }}</h2>
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        @foreach($products as $product)
                        <div class="col-4">
                            <div class="card">
                                <div class="card-header text-center">{{ $product->name }}</div>
                                <div class="card-body text-center">
                                    <i class="bi bi-box-seam-fill text-center display-1"></i>
                                    <div class="description">
                                        {{ $product->detail }}
                                    </div>
                                    <div>Price: ${{ number_format($product->price/100, 2) }}</div>
                                    <hr>
                                    <a href="{{ route('purchase.checkout', $product) }}" type="button" class="btn btn-primary d-block">Buy Now!</a>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
