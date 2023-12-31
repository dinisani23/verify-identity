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
<form action="{{ route('input_dl.store') }}" method="POST" class="container">
<h1>Verify Driving License</h1><br><p>*Please enter your information exactly as on the card.</p>
    @csrf
    <div class="row">
        <div class="col-xs-6 col-sm-6 col-md-12">
            <div class="form-group">
                <strong>Name:</strong>
                <input type="text" name="input_dlName" class="form-control" placeholder="Name">
            </div>
        </div>
        <div class="col-xs-6 col-sm-6 col-md-12">
            <div class="form-group">
                <strong>Nationality:</strong>
                <input type="text" class="form-control" name="input_dlNationality" placeholder="MALAYSIA" disabled>
            </div>
        </div>
        <div class="col-xs-6 col-sm-6 col-md-12">
            <div class="form-group">
                <strong>ID Number:</strong>
                <input type="text" class="form-control" name="input_dlID" placeholder="**001122334455">
            </div>
        </div>
        <div class="col-xs-6 col-sm-6 col-md-12">
            <div class="form-group">
                <label><strong>Class: </strong><label>
                    <select class="form-control" name="input_dlClass" id="class" placeholder="Class">
      	            <option value="A">A</option>
                    <option value="A1">A1</option>
                    <option value="B">B</option>
                    <option value="B1">B1</option>
                    <option value="B2">B2</option>
                    <option value="C">C</option>
                    <option value="D">D</option>
                    <option value="DA">DA</option>
                    <option value="E">E</option>
                    <option value="F">F</option>
                    <option value="G">G</option>
                    <option value="H">H</option>
                    <option value="I">I</option>
                    </select> 
            </div>
        </div>
        <div class="col-xs-6 col-sm-6 col-md-12">
            <div class="form-group">
                <strong>Validity:</strong>
                <input type="text" class="form-control" name="input_dlValidity" placeholder="DD/MM/YYYY - DD/MM/YYYY">
            </div>
        </div>
        <div class="col-xs-6 col-sm-6 col-md-12">
            <div class="form-group">
                <strong>Address:</strong>
                <input type="text" class="form-control" name="input_dlAddress" placeholder="Address">
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