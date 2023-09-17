@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <h2>{{ __('Interesting Products') }}</h2>
            <div class="row">
                <div class="col-md-10">
                    <div class="row">
                        @foreach($products as $product)
                        <div class="col-4">
                            <div class="card">
                                <div class="card-header">{{ $product->name }}</div>
                                    <div class="card-body">
                                        <div class="description">
                                            {{ $product->detail }}
                                        </div>
                                        <div>Price: {{ $product->price }}</div>
                                        <a href="{{ route('purchase.checkout', ['pid' => $product->id]) }}" type="button" class="btn btn-primary">Buy</a>
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
