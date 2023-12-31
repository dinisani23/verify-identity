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
<body>
 
@if ($errors->any())
    <div class="alert alert-danger">
        <strong>Whoops!</strong> There were some problems with your input.<br><br>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="boxcard">
<form action="{{ route('input_ic.store') }}" method="POST" class="container">
<h1>Verify Identity Card</h1><br><p>*Please enter your information exactly as on the card.</p>
    @csrf
    <div class="row">
        <div class="col-xs-6 col-sm-6 col-md-12">
            <div class="form-group">
                <strong>Identity Card Number:</strong>
                <input type="text" name="input_ID" class="form-control" placeholder="**001122-33-4455">
            </div>
        </div>
        <div class="col-xs-6 col-sm-6 col-md-12">
            <div class="form-group">
                <strong>Name:</strong>
                <input type="text" class="form-control" name="input_name" placeholder="Name">
            </div>
        </div>
        <div class="col-xs-6 col-sm-6 col-md-12">
            <div class="form-group">
                <strong>Address:</strong>
                <input type="text" class="form-control" name="input_address" placeholder="Address">
            </div>
        </div>
        <div class="col-xs-6 col-sm-6 col-md-12">
            <div class="form-group">
                <strong>Citizenship:</strong>
                <input type="text" class="form-control" name="input_citizenship" placeholder="WARGANEGARA" disabled>
            </div>
        </div>
        <div class="col-xs-6 col-sm-6 col-md-12">
            <div class="form-group">
                <strong>Religion:</strong>
                <input type="text" class="form-control" name="input_religion" placeholder="Religion">
            </div>
        </div>
        <div class="col-xs-6 col-sm-6 col-md-12">
            <div class="form-group">
                <label><strong>Gender: </strong><label>
                    <select class="form-control" name="input_gender" id="gender" placeholder="Gender">
      	            <option value="PEREMPUAN">PEREMPUAN</option>
                    <option value="LELAKI">LELAKI</option>
                    </select> 
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </div>
   
</form>
</div>
</body>
@endsection

@push('js')
    <script src="{{ asset('argon/vendor/chart.js/dist/Chart.min.js') }}"></script>
    <script src="{{ asset('argon/vendor/chart.js/dist/Chart.extension.js') }}"></script>
@endpush
@endauth
Please <a href="{{ route('login') }}">Sign In</a>.