@extends('layouts.app')
@section('title','Edytor komentarzy')
@section('content')
<div class="title"> <h3>Dodaj komentarz</h3> </div>
<div class="table-container bg-gradient">
    <!-- /.box-header -->
    <!-- form start -->
    <form  action="{{ route('comments.update',$comment) }}" id="comment-form" method="post" enctype="multipart/form-data" >
        @csrf
        <input name="_method" type="hidden" value="PUT">
        <div class="box border border-secondary py-1" >
            <div class="box-body" >
                <div class="form-group{{ $errors->has('message')?'has-error':'' }}" id="roles_box">
                    <div class="mb-3">
                        <textarea class="form-control" id="opis" name="opis" type="text" placeholder="Komentarz" style="height: 10rem; width: 50rem" data-sb-validations="required">{{$comment->comment}}</textarea>
                        <div class="invalid-feedback" data-sb-feedback="opis:required">Opis is required.</div>
                    </div>
                </div>
                <div class="box-footer"><button type="submit" class="btn btn-success">Dodaj</button>
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
