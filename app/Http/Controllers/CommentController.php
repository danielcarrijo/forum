<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Like;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $comments = Comment::where('thread_id',$id)->with('user')->with('likes')->orderBy('created_at', 'desc')->get();
        return response()->json(array('success' => true, 'comments' => $comments, ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $comment = new Comment;
        $comment->thread_id = $request->thread_id;
        $comment->comment = $request->comment;
        $comment->user_id = $request->user_id;
        $comment->save();
        return  response()->json(array('success' => true, 'id' => $comment->id ));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function show(Comment $comment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function edit(Comment $comment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Comment $comment)
    {
        //
    }

    public function like($comment_id) {
        if(Auth::guest()) {
            return response()->json(['success' => 0]);
        }
        $user_id = Auth::user()->id;
        $like = Like::where('comment_id',$comment_id)->where('user_id',$user_id)->first();
        if($like == null) {
            $like = new Like;
            $like->comment_id = $comment_id;
            $like->user_id = $user_id;
            $like->like = 1;
        }
        else {
            $like->like  = 1;
        }
        $like->save();
        return response()->json(['success'=>1]);
    }

    public function dislike($comment_id) {
        if(Auth::guest()) {
            return response()->json(['success' => 0]);
        }
        $user_id = Auth::user()->id; 
        $like = Like::where('comment_id',$comment_id)->where('user_id',$user_id)->first();
        if($like == null) {
            $like = new Like;
            $like->comment_id = $comment_id;
            $like->user_id = $user_id;
            $like->like = -1;

        }
        else {
            $like->like  = -1;
        }
        $like->save();
        return response()->json(['success'=>1]);
    }

    public function check($comment_id,$user_id) {
        $like = Like::where('comment_id',$comment_id)->where('user_id',$user_id)->first();
        if($like != null) {
            return response()->json(array('success' => true, 'like' => $like->like ));
        }
        return response()->json(array('success' => true, 'like' => 0 ));
    }

    public function unlike($comment_id) {
        $user_id = Auth::user()->id; 
        $like = Like::where('comment_id',$comment_id)->where('user_id',$user_id)->first();
        $like->delete();        
        return response()->json(['success' => true]);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $comment = Comment::find($id);
        $comment->delete();
        return redirect()->back();
    }
}
