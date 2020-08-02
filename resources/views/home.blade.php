@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Add Balance') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <form action="{{ URL::to('charge') }}" method="post" id="payment-form">
                        <div class="form-row">
                            <input type="text" name="first_name" class="form-control mb-3 StripeElement StripeElement--empty" placeholder="First Name">
                            <input type="text" name="last_name" class="form-control mb-3 StripeElement StripeElement--empty" placeholder="Last Name">
                            <input type="text" name="email" class="form-control mb-3 StripeElement StripeElement--empty" placeholder="Email Address">
                            <input type="text" name="amount" class="form-control mb-3 StripeElement StripeElement--empty" placeholder="For E.G. 50">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <div id="card-element" class="form-control">
                            <!-- A Stripe Element will be inserted here. -->
                            </div>
            
                            <!-- Used to display form errors. -->
                            <div id="card-errors" role="alert"></div>
                        </div>
                        <button>Submit Payment</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
