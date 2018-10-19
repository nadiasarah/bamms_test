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
        <br>
        @if(session('success'))
          <div class="alert alert-success">
              {{session('success')}}
          </div>
        @elseif ($errors->any())
              <div class="alert alert-danger">
                  <ul>
                      @foreach ($errors->all() as $error)
                          <li>{{ $error }}</li>
                      @endforeach
                  </ul>
              </div>
          @endif
        <form class="" method="post">
          {{ csrf_field() }}
          <div class="form-group">
            <label for="amount">Amount</label>
            <input type="text" class="form-control col-5" id="amount" name="amount" placeholder="Enter amount to deposit" required>
          </div>
          <div class="modal" tabindex="-1" role="dialog" id="confirm-modal">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title">Confirm transaction</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <p>Are you sure you want to do this transaction?</p>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                  <button type="submit" class="btn btn-primary">Yes</button>
                </div>
              </div>
            </div>
          </div>
          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#confirm-modal">Submit</button>
        </form>
      </div>
    </div>
  </div>
@endsection
