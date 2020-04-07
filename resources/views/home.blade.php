@extends('layouts.app')

@section('content')
<div class="container-fluid mt-3 full-height">
    <div class="row full-height mt-1">
        <nav class="col-md-2 d-none bg-blue d-lg-block navigation border-right" style="height:100%;">
            <div class="sidebar-sticky mt-4">
                <ul class="nav flex-column">
                <li class="nav-item mt-2 my-3">
                    <a class="nav-link text-white active" href="/">
                    <div class="row">
                    <span class="ml-3 bagde badge-secondary rounded-circle"></span> 
                    <span class="ml-auto mr-3">{{Auth::user()->username}}</span> 
                    </div>
                    
                    </a>
                </li>
                <li class="nav-item rounded-pill border mt-2">
                    <a class="nav-link text-white active" href="{{route('thread.index')}}">
                    <div class="row">
                    <span class="ml-auto mr-3">My Threads </span> 
                    </div>
                    
                    </a>
                </li>
                <li class="nav-item rounded-pill border mt-2">
                    <a class="nav-link text-white " href="{{route('welcome.filter', ['topic' => 'Sports'])}}">
                    <div class="row">
                        <span class="ml-auto mr-3">My activities</span> 
                    </div>
                    </a>
                </li>
                <li class="nav-item rounded-pill border mt-2">
                    <a class="nav-link text-white" href="{{route('welcome.filter', ['topic' => 'Politcs'])}}">
                    <span data-feather="file"></span>
                    Politcs
                    </a>
                </li>
                <li class="nav-item rounded-pill border mt-2">
                    <a class="nav-link text-white" href="{{route('welcome.filter', ['topic' => 'Health'])}}">
                    Health
                    </a>
                </li>
                <li class="nav-item rounded-pill border mt-2">
                    <a class="nav-link text-white" href="{{route('welcome.filter', ['topic' => 'Programming'])}}">
                    Programming
                    </a>
                </li>
                <li class="nav-item rounded-pill border mt-2">
                    <a class="nav-link text-white" href="{{route('welcome.filter', ['topic' => 'Games'])}}">
                    Games
                    </a>
                </li>
                <li class="nav-item rounded-pill border mt-2">
                    <a class="nav-link text-white" href="{{route('welcome.filter', ['topic' => 'Economy'])}}">
                    Economy
                    </a>
                </li>
                <li class="nav-item rounded-pill border mt-2">
                    <a class="nav-link text-white" href="{{route('welcome.filter', ['topic' => 'Others'])}}">
                    Others
                    </a>
                </li>
                </ul>
            </div>
         </nav>
         <div class="col-lg-8 col-sm-12 mt-1 border-left border-right mt-2 full-height">
            @yield('conteudo')
        </div>
    </div>
</div>
@endsection
