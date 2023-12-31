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
<form action="{{ route('verification_dl.update',$inputDL->id) }}" method="POST" class="container">
<h1>Update Record</h1>
    @csrf
    <div class="row">
        <div class="col-xs-6 col-sm-6 col-md-12">
            <div class="form-group">
                <strong>Name:</strong>
                <input type="text" name="input_dlName" class="form-control" placeholder="Name" value="{{ $inputDL->input_dlName }}">
            </div>
        </div>
        <div class="col-xs-6 col-sm-6 col-md-12">
            <div class="form-group">
                <strong>Nationality:</strong>
                <input type="text" class="form-control" name="input_dlNationality" placeholder="Nationality" value="{{ $inputDL->input_dlNationality }}">
            </div>
        </div>
        <div class="col-xs-6 col-sm-6 col-md-12">
            <div class="form-group">
                <strong>ID Number:</strong>
                <input type="text" class="form-control" name="input_dlID" placeholder="**001122334455" value="{{ $inputDL->input_dlID }}">
            </div>
        </div>
        <div class="col-xs-6 col-sm-6 col-md-12">
            <div class="form-group">
                <strong>Class:</strong>
                <input type="text" class="form-control" name="input_dlClass" placeholder="Class" value="{{ $inputDL->input_dlClass }}">
            </div>
        </div>
        <div class="col-xs-6 col-sm-6 col-md-12">
            <div class="form-group">
                <strong>Validity:</strong>
                <input type="text" class="form-control" name="input_dlValidity" placeholder="DD/MM/YYYY - DD/MM/YYYY" value="{{ $inputDL->input_dlValidity }}">
            </div>
        </div>
        <div class="col-xs-6 col-sm-6 col-md-12">
            <div class="form-group">
                <strong>Address:</strong>
                <input type="text" class="form-control" name="input_dlAddress" placeholder="Address" value="{{ $inputDL->input_dlAddress }}">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
            <button type="submit" class="btn btn-primary">Update</button>
            <a class="btn btn-primary" href="{{ route('verification_dl.list') }}"> Back</a>
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