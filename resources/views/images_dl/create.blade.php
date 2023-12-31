@auth()
@extends('layouts.template')
@section('content')
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
body {
  font-family: Arial, Helvetica, sans-serif;
  background-color: ;
}

* {
  box-sizing: border-box;
}

/* Add padding to containers */
.container {
  padding: 16px;
  background-color: white;
  margin-top:100px;
}


input[type=text] {
  width: 100%;
  padding: 15px;
  margin: 5px 0 22px 0;
  display: inline-block;
  border: none;
  background: #f1f1f1;
}

input[type=text]:focus, input[type=password]:focus {
  background-color: #ddd;
  outline: none;
}

.registerbtn {
  background-color: #04AA6D;
  color: white;
  padding: 16px 20px;
  margin: 8px 0;
  border: none;
  cursor: pointer;
  width: 100%;
  opacity: 0.9;
}

.registerbtn:hover {
  opacity: 1;
}

a {
  color: dodgerblue;
}

</style>
</head>
<body>

@if ($errors->any())
   <div class="alert alert-danger">
     <ul>
     @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
     @endforeach
     </ul>
   </div>
@endif

<form action="{{ route('images_dl.store') }}" method="post" enctype="multipart/form-data">
@csrf
  <div class="container">
    <div class="row">
      <div class="col-xs-6 col-sm-6 col-md-12">
        <div class="form-group">
          <label><b>Upload Driving License Here (.jpg)</b></label>
          <input type="file" id="imageDL" name="imageDL" required class="form-control">
        </div>
      </div>
      <div class="col-xs-12 col-sm-12 col-md-12 text">
        <button type="submit" class="btn btn-primary">Submit</button>
      </div>
    </div>
  </div>  
</form>

</body>
</html>
@endsection
@endauth
Please <a href="{{ route('login') }}">Sign In</a>.