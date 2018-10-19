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
        <h3>Account number: {{$account_number}}</h3>
        <table class="table">
          <tr>
            <th>No.</th>
            <th>Type</th>
            <th>Transaction</th>
            <th>Amount</th>
            <th>Receiver</th>
            <th>Date and Time</th>
          </tr>
          @foreach ($transactions as $key => $value)
            <tr>
              <td>{{$key+1}}</td>
              <td>
                @if ($value->type == 1)
                  +
                @else
                  -
                @endif
              </td>
              <td>{{$value->name}}</td>
              <td>Rp {{$value->amount}}</td>
              <td>{{$value->receiver_account_number}}</td>
              <td>{{$value->created_at}}</td>
            </tr>
          @endforeach
        </table>
      </div>
    </div>
  </div>
@endsection
