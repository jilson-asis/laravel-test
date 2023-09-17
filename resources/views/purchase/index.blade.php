@extends('layouts.app')


@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="float-start">
                <h2>Purchases</h2>
            </div>
        </div>
    </div>


    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif


    <table class="table table-bordered">
        <tr>
            <th>No</th>
            <th>User Email</th>
            <th>Last Card Number</th>
            <th>DateTime</th>
        </tr>
        @if ($purchases->isNotEmpty())
            @foreach ($purchases as $purchase)
                <tr>
                    <td>{{ $purchase->id }}</td>
                    <td>{{ $purchase->user->email }}</td>
                    <td>{{ $purchase->last_four }}</td>
                    <td>{{ $purchase->created_at->format('Y-m-d H:i:s') }}</td>
                </tr>
            @endforeach
        @endif
    </table>
    @if ($purchases->isNotEmpty())
        {!! $purchases->render() !!}
    @endif


@endsection
