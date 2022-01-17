@extends('layouts.app')
@section('title','Profil użytkownika')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Profil użytkownika: {{Auth::user()->name}}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        Email: {{Auth::user()->email}}<br>
                        Avatar: <img class="image rounded-circle" src="{{asset('/storage/images/'.Auth::user()->image)}}" alt="profile_image" style="width: 80px;height: 80px; padding: 10px; margin: 0px; ">
                    </div>
                    <div class="card-body">
                        <span>Zmień avatar:</span>
                        <form action="{{route('home')}}" method="POST" enctype="multipart/form-data" >
                            @csrf
                            <input type="file" name="image" value="zmień avatar">
                            <input type="submit" value="Zmień">
                        </form>
                    </div>
                    <div class="card-body">
                        <form action="{{route('change-password.index')}}" method="get" enctype="multipart/form-data" >
                        <input type="submit"  value="Zmień hasło">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
