@extends('layouts.app')


@section('content')
    <div class="row">
        <div class="col-6 offset-3 text-center">
            <h3>Payment Success!</h3>
            <p class="card p-5">
                Thank you {{ $user->name }} for purchasing our product. Please wait while we process your order.
            </p>
        </div>
    </div>
@endsection
