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
<form action="{{ route('verification_ic.update',$inputIC->id) }}" method="POST" class="container">
<h1>Update Record</h1>
    @csrf
    <div class="row">
        <div class="col-xs-6 col-sm-6 col-md-12">
            <div class="form-group">
                <strong>Identity Card Number:</strong>
                <input type="text" name="input_ID" class="form-control" placeholder="**001122-33-4455" value="{{ $inputIC->input_ID }}">
            </div>
        </div>
        <div class="col-xs-6 col-sm-6 col-md-12">
            <div class="form-group">
                <strong>Name:</strong>
                <input type="text" class="form-control" name="input_name" placeholder="Name" value="{{ $inputIC->input_name }}">
            </div>
        </div>
        <div class="col-xs-6 col-sm-6 col-md-12">
            <div class="form-group">
                <strong>Address:</strong>
                <input type="text" class="form-control" name="input_address" placeholder="Address" value="{{ $inputIC->input_address }}">
            </div>
        </div>
        <div class="col-xs-6 col-sm-6 col-md-12">
            <div class="form-group">
                <strong>Citizenship:</strong>
                <input type="text" class="form-control" name="input_citizenship" placeholder="Citizenship" value="{{ $inputIC->input_citizenship }}">
            </div>
        </div>
        <div class="col-xs-6 col-sm-6 col-md-12">
            <div class="form-group">
                <strong>Religion:</strong>
                <input type="text" class="form-control" name="input_religion" placeholder="Religion" value="{{ $inputIC->input_religion}}">
            </div>
        </div>
        <div class="col-xs-6 col-sm-6 col-md-12">
            <div class="form-group">
                <strong>Gender:</strong>
                <input type="text" class="form-control" name="input_gender" placeholder="Gender" value="{{ $inputIC->input_gender }}">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
            <button type="submit" class="btn btn-primary">Update</button>
            <a class="btn btn-primary" href="{{ route('verification_ic.list') }}"> Back</a>
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