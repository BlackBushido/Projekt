@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Formularz zmiany hasła</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('change-password.store') }}">
                            @csrf

                            @foreach ($errors->all() as $error)
                                <p class="text-danger">{{ $error }}</p>
                            @endforeach

                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">Obecne hasło</label>

                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control mb-2" name="Obecne_hasło" autocomplete="current-password">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">Nowe hasło</label>

                                <div class="col-md-6">
                                    <input id="new_password" type="password" class="form-control mb-2" name="nowe_hasło" autocomplete="current-password">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">Podaj ponownie nowe hasło</label>

                                <div class="col-md-6">
                                    <input id="new_confirm_password" type="password" class="form-control mb-2" name="podaj_ponownie_nowe_hasło" autocomplete="current-password">
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        Zmień hasło
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
