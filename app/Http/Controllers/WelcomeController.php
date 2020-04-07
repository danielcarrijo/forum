<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Thread;
class WelcomeController extends Controller
{
    public function index()
    {
        $threads = Thread::orderby('created_at','desc')->get();

        return view('welcome',['threads' => $threads]);
    }

    public function filter($topic)
    {
        $threads = Thread::where('topic',$topic)->get();
        return view('welcome',['threads' => $threads]);
    }
}
