<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use function PHPUnit\Framework\isEmpty;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(Auth::user() == null){
            return Redirect::back()->withErrors(['msg' => "Musisz się zalogować aby dodać post"]);
        }
        return view('postsForm');
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

        $comment = new Post();
        $comment->user_id=Auth::user()->id;
        $comment->topic=$request->temat;
        $comment->comment=$request->opis;
        if($comment->save()){
            return redirect('home');
        }
        return view('home');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::findOrFail($id);

        return view('postsEditForm', ['post'=>$post]);
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
        $post = Post::findOrFail($id);

        $post->topic = $request->temat;
        $post->comment = $request->opis;

        $comments = Comment::query()->where('post_id','LIKE',$post->id)->get();
        if($post->save()) {
            return redirect()->route('comments.show',['comment'=>$post->id]);
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
        $post = Post::findOrFail($id);
        $comments = Comment::query()->where('post_id','LIKE',$id )->get();
        foreach ($comments as $comment)
            $comment->delete();
        //Sprawdz czy użytkownik jest autorem komentarza:

        if($post->delete()){
            return redirect()->route('home');
        }
        else return back();
    }

    public function search(Request $request){
        // Get the search value from the request
        $search = $request->input('search');
        $user= User::query()->where('name', 'LIKE',"%{$search}%")->get();
        $posts = Post::query()
            ->where('topic', 'LIKE', "%{$search}%")
            ->orWhere('comment', 'LIKE', "%{$search}%")
            ->get();

        for($i = 0; $i<count($posts); $i+=1){
            $posts[$i]['commentsCount'] = Comment::where('post_id',$posts[$i]->id)->count();
        }

        return view('home',['posts'=>$posts]);
    }
}
