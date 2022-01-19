@extends('layouts.app')
@section('title','Projekt')
@section('content')
    <h2 style="text-align: center">Posty użytkowników:</h2>
<section class="content-item" id="comments">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 mx-auto bg-gradient">
                <form style="text-align: center"  action="{{ route('searchPosts')}}" method="GET">
                    <input type="text" name="search" required/>
                    <button type="submit">Wyszukaj</button>
                </form>
                <!-- POSTS - START -->
                @if(!$posts->isEmpty())
                    @foreach($posts as $post)
                        <a class="nav-link text-dark" href="{{route('comments.show',['comment'=>$post])}}">
                            <div class="media">
                               <img class="media-object image rounded-circle mr-2" src={{asset('images/'.$post->user->image)}} alt="">
                                <div class="media-body">
                                    <h3 class="media-heading">{{$post->topic}}</h3>
                                    <h4 class="media-heading">{{$post->user->name}}</h4>
                                    <p>{{$post->comment}}</p>
                                    <ul class="list-unstyled list-inline media-detail pull-left">
                                        <li><i class="fa fa-calendar"></i>{{$post->created_at}}</li>
                                        <li><i class="fa fa-book"></i>{{$post->commentsCount}}</li>
                                    </ul>
                                </div>
                            </div>
                        </a>
                    @endforeach
                    @else
                        <h1 style="text-align: center">Brak postów</h1>
                    @endif
                <div class="footer-button text-md-center">
                    <a style="font-size: x-large" href="{{ route('create') }}" class="btn btn-secondary mt-2 w-25">Dodaj post</a>
                </div>
            </div>
        </div>
    </div>

</section>
@endsection
