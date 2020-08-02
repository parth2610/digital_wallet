@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2>Transaction of Rs.{{$topup}} is Successful.</h2>
    <hr>
<p>Your Transaction ID is {{$tid}}</p>
<p>Your Current Balance is Rs.{{$balance}}</p>
    <p>Check your email for more information.</p>
    <p><a href="{{ URL::to('/')}}" class="btn btn-light mt-2">Go Back</a></p>
</div>
@endsection