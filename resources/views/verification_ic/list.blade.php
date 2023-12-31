@auth()
@extends('layouts.template')
@section('content')
<html>
<head>
<style>
.boxcard {
  box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
  transition: 0.3s;
  width: 100%;
  border-radius: 5px;
  margin-left: 5px;
  margin-top:100px;
}

.container {
  padding: 30px 0px;
  margin-left: 50px;
}
table {
        white-space: nowrap;
    }
</style>

<script>
    function toggleText() {
        var shortText = document.getElementById("shortText");
        var fullText = document.getElementById("fullText");
        var moreLink = document.getElementById("moreLink");
        if (shortText.style.display === "none") {
            shortText.style.display = "inline";
            fullText.style.display = "none";
        } else {
            shortText.style.display = "none";
            fullText.style.display = "none";
            moreLink.innerHTML = "...";
        }
    }
</script>

<div class="">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 margin-tb" style="margin-top:50px;">
                <div class="pull-left">
                    <h2>Valid Identity Card List</h2>
                </div>
                <div class="pull-right">
                    <a class="btn btn-success" href="{{ route('input_ic.create') }}"> Add New Record</a>
                </div>
                @if ($message = Session::get('success'))
                <div class="alert alert-success">
                    <p>{{ $message }}</p>
                </div>
                @endif
        
                <br>
                <table class="table table-bordered">
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Address</th>
                        <th>Citizenship</th>
                        <th>Religion</th>
                        <th>Gender</th>
                        <th width="280px">Action</th>
                    </tr>


                    @foreach ($data as $t)
                    <tr>
                        <td>{{ $t->input_ID }}</td>
                        <td>{{ $t->input_name }}</td>
                        <td> {{ substr($t->input_address, 0, 20) . "..." }} </td>
                        <td>{{ $t->input_citizenship }} </td>
                        <td>{{ $t->input_religion }}</td>
                        <td>{{ $t->input_gender }}</td>
                        <td>
                            <form action="{{ route('verification_ic.destroy',$t->id) }}" method="POST">
                
                                <a class="btn btn-primary" href="{{ route('verification_ic.edit',$t->id) }}">Edit</a>
            
                                @csrf
                                @method('DELETE')
                
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </table>
                {{ $data->links('verification_ic.pagination') }}
            </div>
        </div>
    </div>
</div>
@endsection
@endauth
Please <a href="{{ route('login') }}">Sign In</a>.