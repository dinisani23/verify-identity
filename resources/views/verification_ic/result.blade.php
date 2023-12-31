@auth()
@extends('layouts.template')
@section('content')

<html>
<head>
<style>
.boxcard {
  box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
  transition: 0.3s;
  width: 50%;
  border-radius: 5px;
  margin-left: 320px;
  margin-top:100px;
}

.container {
  padding: 30px 20px;
}
</style>
</head>
<div class="boxcard">
  <div class="container">
    <div class="row">
      <div class="col-xs-6 col-sm-6 col-md-12">
        <div class="form-group">
          <h2> Identity Card Verification Result </h2><br>
          <p> Result is {{ $count }}% accurate</p>
          <p style="color:red;"> {{ $incomplete }} does not match. </p>
          <div class="col-xs-12 col-sm-12 col-md-12 text-center">
            <a id="jpj-button" class="btn btn-primary" href="{{ route('verification_ic.verify_spr') }}">Verify ID with Suruhanjaya Pilihan Raya Malaysia</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection
@endauth
Please <a href="{{ route('login') }}">Sign In</a>.