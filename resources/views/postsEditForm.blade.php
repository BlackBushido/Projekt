@extends('layouts.app')
@section('title','Edytor postów')
@section('content')
<div class="title"> <h3>Edytuj post</h3> </div>
<div class="table-container bg-gradient">
    <!-- /.box-header -->
    <!-- form start -->
    <form  action="{{ route('update', $post) }}" id="comment-form" method="post" enctype="multipart/form-data" >
        @csrf
        <div class="box border border-secondary py-1" >
            <div class="box-body" >
                <div class="form-group{{ $errors->has('message')?'has-error':'' }}" id="roles_box">
                    <div class="mb-3 ">
                        <label class="form-label" for="temat">Temat</label>
                        <select class="form-select" id="temat" name="temat" aria-label="Temat" style="width:10rem;">
                            <option selected value="Ciągniki rolnicze">Ciągniki rolnicze</option>
                            <option value="Kombajny">Kombajny</option>
                            <option value="Produkcja roślinna">Produkcja roślinna</option>
                            <option value="Produkcja zwierzęca">Produkcja zwierzęca</option>
                            <option value="Inne">Inne</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="opis">Opis</label>
                        <textarea class="form-control" id="opis" name="opis" type="text" placeholder="Opis" style="height: 10rem; width: 50rem" data-sb-validations="required">{{$post->comment}}</textarea>
                        <div class="invalid-feedback" data-sb-feedback="opis:required">Opis is required.</div>
                    </div>
                </div>
                <div class="box-footer"><button type="submit" class="btn btn-success">Edytuj</button>
                </div>
            </div>

        </div>
    </form>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
</div>
@endsection
