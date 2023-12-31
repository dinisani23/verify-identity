@extends('layouts.template', ['class' => 'bg-default'])
@if (session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif

@section('content')
    <div class="header bg-gradient-primary py-7 py-lg-8">
        <div class="container">
            <div class="header-body text-center mt-7 mb-7">
                <div class="row justify-content-center">
                    <div class="col-lg-5 col-md-6">
                        <img src="https://cdn.discordapp.com/attachments/700352419317416078/1067820691648413766/Modern_Typography_Technology_Logo__3_-removebg-preview.png">
                        <div class="col-xs-12 col-sm-12 col-md-12 text-center" style="margin-left:30px;">
                            <a class="btn btn-outline-default" href="{{ route('login') }}">Sign In</a>
                            <a class="btn btn-outline-default" href="{{ route('register') }}">Create Account</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="separator separator-bottom separator-skew zindex-100">
            <svg x="0" y="0" viewBox="0 0 2560 100" preserveAspectRatio="none" version="1.1" xmlns="http://www.w3.org/2000/svg">
                <polygon class="fill-default" points="2560 0 2560 100 0 100"></polygon>
            </svg>
        </div>
    </div>

    <div class="container mt--10 pb-5"></div>
@endsection
