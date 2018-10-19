@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col-2">
        <ul>
          <li><a href="/deposit">Deposit</a></li>
          <li><a href="/withdraw">Withdraw</a></li>
          <li><a href="/transfer">Transfer</a></li>
          <li><a href="/mutation">Mutation</a></li>
        </ul>
      </div>
      <div class="col-10">
        <h2>Welcome, {{$customer_name}}</h2>
        <h3>Account number: {{$account_number}}</h3>
      </div>
    </div>
  </div>
@endsection
