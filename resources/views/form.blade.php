


@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-sm-12">
            <div class="card">
                {{$id}}
            <script src="https://eu-test.oppwa.com/v1/paymentWidgets.js?checkoutId={{$id}}"></script>
            <form action="{{ route('hyperpay_pay') }}" class="paymentWidgets" data-brands="VISA MASTER AMEX"></form>
            </div>
        </div>
    </div>
</div>
@endsection

