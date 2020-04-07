<?php

namespace App\Http\Controllers;

use App\Thread;
use App\Like;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class ThreadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $threads = Thread::where('user_id',Auth::user()->id)->get();
        return view('home/threads',['threads' => $threads]);
    }

   

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('thread/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $thread = new Thread;
        $thread->title = $request->title;
        $thread->subtitle = $request->subtitle;
        $thread->description = $request->description;
        $thread->topic = $request->topic;
        $thread->user_id = Auth::user()->id;
        if($request->topic == 'Programming') {
            $thread->code = $request->code;
        }
        $thread->save();
        return response()->json(['success'=>'']);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Thread  $thread
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $thread = Thread::with(['comments'=>function($query){
            $query->with('user')->with('likes')->orderBy('created_at','desc');
        }])->find($id);
        return view('thread/show', ['thread' => $thread]);
    }


    public function like($thread_id) {
        if(Auth::guest()) {
            return response()->json(['success' => 0]);
        }
        $user_id = Auth::user()->id;
        $like = Like::where('thread_id',$thread_id)->where('user_id',$user_id)->first();
        if($like == null) {
            $like = new Like;
            $like->thread_id = $thread_id;
            $like->user_id = $user_id;
            $like->like = 1;

        }
        else {
            $like->like  = 1;
        }
        $like->save();
        return response()->json(['success'=>1]);
    }

    public function dislike($thread_id) {
        if(Auth::guest()) {
            return response()->json(['success' => 0]);
        }
        $user_id = Auth::user()->id;
        $like = Like::where('thread_id',$thread_id)->where('user_id',$user_id)->first();
        if($like == null) {
            $like = new Like;
            $like->thread_id = $thread_id;
            $like->user_id = $user_id;
            $like->like = -1;

        }
        else {
            $like->like  = -1;
        }
        $like->save();
        return response()->json(['success'=>1]);
    }

    public function check($thread_id,$user_id) {
        $like = Like::where('thread_id',$thread_id)->where('user_id',$user_id)->first();
        if($like != null) {
            return response()->json(array('success' => true, 'like' => $like->like ));
        }
        return response()->json(array('success' => true, 'like' => 0 ));
    }

    public function unlike($thread_id) {
        $user_id = Auth::user()->id; 
        $like = Like::where('thread_id',$thread_id)->where('user_id',$user_id)->first();
        $like->delete();        
        return response()->json(['success' => true]);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Thread  $thread
     * @return \Illuminate\Http\Response
     */
    public function edit(Thread $thread)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Thread  $thread
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Thread $thread)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Thread  $thread
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $thread = Thread::find($id);
        $thread->delete();
        return redirect()->route('home');
    }
}
