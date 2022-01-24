@extends('layouts.app')
@section('title','Komentarze')
@section('content')
@if($errors->any())
    <h4 style="text-align: center" class="text-danger">{{$errors->first()}}</h4>
@endif
<section class="content-item" id="comments">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 bg-gradient">
                <form style="text-align: center"  action="{{ route('searchComments', ['id'=>$post['id']])}}" method="GET">
                    <input type="text" name="search" required/>
                    <button type="submit">Wyszukaj</button>
                </form>
                    <div class="media">
                        <img class="media-object image rounded-circle mr-2" src={{asset('images/'.$post['user']->image)}} alt="">
                        <div class="media-body">
                            <h3 class="media-heading">{{$post['topic']}}</h3>
                            <h4 class="media-heading">{{$post['user']->name}}</h4>
                            <p>{{$post['comment']}}</p>
                            <ul class="list-unstyled list-inline media-detail pull-left">
                                <li><i class="fa fa-calendar"></i>{{$post['created_at']}}</li>
                                <li><i class="fa fa-book"></i>{{$post['commentsCount']}}</li>
                            </ul>
                            @auth
                                @if($post['user_id'] == Auth::user()->id)

                                    <a href="{{ route('delete', ["id"=>$post['id']]) }}"
                                       class="btn btn-danger btn-xs float-end"
                                       onclick="return confirm('Jesteś pewien?')"
                                       title="Skasuj"> Usuń
                                    </a>
                                    <a href="{{ route('edit', $post) }}" class="btn btn-success btn-xs float-end mr-2"
                                       title="Edytuj"> Edytuj
                                    </a>
                                @endif
                            @endauth
                        </div>
                    </div>
                @if(!$comments->isEmpty())
                @foreach($comments as $comment)
                    <div style="background-color: lightblue" class="media mt-2">
                        <img class="media-object image rounded-circle mr-2" src={{asset('images/'.$comment->user->image)}} alt="">
                        <div class="media-body">
                            <h4 class="media-heading">{{$comment->user->name}}</h4>
                            <p>{{$comment->comment}}</p>
                            <ul class="list-unstyled list-inline media-detail pull-left">
                                <li><i class="fa fa-calendar"></i>{{$comment->created_at}}</li>
                            </ul>
                            @auth
                                @if($comment['user_id'] == Auth::user()->id)
                                    <div>
                                    <a href="{{ route('delComment', ['id'=>$comment]) }}"
                                       class="btn btn-danger btn-xs float-end"
                                       onclick="return confirm('Jesteś pewien?')"
                                       title="Skasuj"> Usuń
                                    </a>
                                    <a href="{{ route('comments.edit', $comment) }}" class="btn btn-success btn-xs float-end mr-2"
                                       title="Edytuj"> Edytuj
                                    </a>
                                    </div>
                                @endif
                            @endauth
                        </div>
                    </div>
                @endforeach
                @else
                    <h1 style="text-align: center">Brak komentarzy</h1>
                @endif
                <div class="footer-button text-md-center">
                    <a href="{{ route('comments.create',['id'=>$post['id']]) }}" class="btn btn-secondary mt-2">Dodaj komentarz</a>
                </div>
            </div>
        </div>
    </div>

</section>
@endsection
