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
                    <h2>Valid Driving License List</h2>
                </div>
                <div class="pull-right">
                    <a class="btn btn-success" href="{{ route('input_dl.create') }}"> Add New Record</a>
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
                        <th>Nationality</th>
                        <th>Class</th>
                        <th>Validity</th>
                        <th>Address</th>
                        <th width="280px">Action</th>
                    </tr>


                    @foreach ($data as $t)
                    <tr>
                        <td>{{ $t->input_dlID }}</td>
                        <td>{{ $t->input_dlName }}</td>
                        <td>{{ $t->input_dlNationality }}</td>
                        <td>{{ $t->input_dlClass }} </td>
                        <td>{{ $t->input_dlValidity }}</td>
                        <td>{{ substr($t->input_dlAddress, 0, 20) . "..." }}</td>
                        <td>
                            <form action="{{ route('verification_dl.destroy',$t->id) }}" method="POST">
                
                                <a class="btn btn-primary" href="{{ route('verification_dl.edit',$t->id) }}">Edit</a>
            
                                @csrf
                                @method('DELETE')
                
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </table>
                {{ $data->links('verification_dl.pagination') }}
            </div>
        </div>
    </div>
</div>
@endsection
@endauth
Please <a href="{{ route('login') }}">Sign In</a>.