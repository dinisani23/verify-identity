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
                    <p><strong>ID entered: </strong>{{ $latestID->input_dlID }}</p>
                        <p><strong>ID extracted from image: </strong>{{ $latestIDextract->dl_ID }}</p>
                        <p><strong>JPJ result fetched based on ID entered:-</strong><br>
                        <strong>Name: </strong>{{ $latestIDscrape->jpj_name }} <br>
                        <strong>ID: </strong>{{ $latestIDscrape->jpj_ICnum }} <br>
                        <strong>ID Category: </strong>{{ $latestIDscrape->jpj_category }}</p>
                        <p><strong> {{ $message_jpj }} on {{ date('D, M j, Y') }}.</strong></p>
                        <div class="col-xs-12 col-sm-12 col-md-12 text-center"> 
                        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                            <a id="jpj-button" class="btn btn-primary" href="{{ route('verification_dl.list') }}">See more results</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@endauth
Please <a href="{{ route('login') }}">Sign In</a>.