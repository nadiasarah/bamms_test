@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Create New Account') }}</div>

                <div class="card-body">
                    <form method="POST">
                        @csrf

                        <div class="form-group row">
                            <label for="type" class="col-md-4 col-form-label text-md-right">{{ __('Account Type') }}</label>

                            <div class="col-md-6">
                              <select class="custom-select" id="type" type="text" class="form-control{{ $errors->has('type') ? ' is-invalid' : '' }}" name="type" required autofocus>
                                <option value="1" selected>Silver</option>
                                <option value="2">Gold</option>
                              </select>

                                @if ($errors->has('type'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('type') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="address" class="col-md-4 col-form-label text-md-right">{{ __('Address') }}</label>

                            <div class="col-md-6">
                                <textarea id="address" type="text" class="form-control" name="address">
                                  {{ old('address') }}
                                </textarea>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="description" class="col-md-4 col-form-label text-md-right">{{ __('Account Description') }}</label>

                            <div class="col-md-6">
                                <textarea id="description" type="text" class="form-control" name="description">
                                  {{ old('description') }}
                                </textarea>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Create Account') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
