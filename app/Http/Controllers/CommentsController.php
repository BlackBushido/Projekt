<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use PhpParser\Node\Scalar\String_;
use function PHPUnit\Framework\isEmpty;
use function PHPUnit\Framework\returnCallback;

class CommentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $comments = new Comment;
        $post = new Post;
        return view('comments',['comments'=>$comments, 'post'=>$post]);
    }

    /**
     * Show the form for creating a new resource.
     *@param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $var = request()->all()['id'];
        if(Auth::user() == null){
            return Redirect::back()->withErrors(['msg' => "Musisz się zalogować aby dodać komentarz"]);
        }
        return view('commentForm',['var'=>$var]);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'opis' => 'required|min:50|max:2000'
        ]);
        $comment = new Comment();
        $comment->user_id=Auth::user()->id;
        $comment->post_id= request()->all()['id'];
        $comment->comment=$request->opis;
        $post=Post::findOrFail($comment->post_id);
        $post['commentsCount'] = Comment::where('post_id',$post->id)->count();
        $data=$post->only(['id','user_id','topic','user','created_at','comment','commentsCount']);
        if($comment->save()){;
            $comments = Comment::query()->where('post_id','LIKE',$comment->post_id )->get();

            return view('comments',['post'=>$data,'comments'=>$comments]);
        }
        return view('comments',['post'=>$data]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post=Post::findOrFail($id);
            $post['commentsCount'] = Comment::where('post_id',$post->id)->count();
        $data=$post->only(['id','user_id','topic','user','created_at','comment','commentsCount']);
        $comments = Comment::query()->where('post_id','LIKE',$id )->get();
        return view('comments',['post'=>$data,'comments'=>$comments]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $comment = Comment::find($id);
        return view('commentsEditForm', ['comment'=>$comment]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $comment = Comment::find($id);

        $comment->comment = $request->opis;
        if($comment->save()) {
            return redirect()->route('comments.show',['comment'=>$comment->post_id]);
        }
        return "Wystąpił błąd.";

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy()
    {
        $id = request()->all()['id'];
        //Sprawdz czy użytkownik jest autorem komentarza:
        $comment = Comment::find($id);

        if($comment->delete()){
            return redirect()->back();
        }
        else return back();
    }

    public function search(Request $request, $id){
        $search = $request->input('search');
        $post=Post::findOrFail($id);
        $post['commentsCount'] = Comment::where('post_id',$post->id)->count();
        $data=$post->only(['id','user_id','topic','user','created_at','comment','commentsCount']);
        $comments = Comment::query()->where('post_id','LIKE',$id )
            ->Where('comment', 'LIKE', "%{$search}%")
            ->get();
        // Return the search view with the resluts compacted
        return view('comments',['post'=>$data, 'comments'=>$comments]);
    }
}
