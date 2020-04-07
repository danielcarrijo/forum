@extends('layouts.welcome')
@section('title')
<title>Forum</title>
@endsection
@section('content')
<ul class="list-group list-group-flush mb-3">
    @foreach($threads as $thread)
        <a href="{{route('thread.show', ['id' => $thread->id])}}" class="text-dark">
            <li 
                class="list-group-item list-group-item-action d-flex 
                justify-content-between align-items-center rounded mb-4 border-down"
                >
                
                    <div class="container">
                        <div class="row">
                            <h4>{{$thread->title}}</h4>
                        </div>
                        <div class="row">
                            <p class="lead">{{$thread->subtitle}}</p>
                        </div>
                        <div class="row mt-3">
                        <span style="font-size: 8pt; font-weight:bold">{{$thread->user->username}}</span>
                        </div>
                        <div class="row">
                            <span style="font-size: 8pt; font-weight:bold">{{count($thread->comments)}} comments - {{count($thread->likes)}} likes - 
                            <?php switch($thread->topic): 
                                case 'Economy': ?>
                                    <i class="fas fa-coins"></i> 
                                    <?php break; ?>
                                <?php case  'Sports': ?>
                                    <i class="fas fa-futbol"></i> 
                                    <?php break; ?>
                                <?php case  'Games': ?>
                                    <i class="fas fa-gamepad"></i> 
                                    <?php break; ?>
                                <?php case  'Health': ?>
                                    <i class="fas fa-gamepad"></i> 
                                    <?php break; ?>
                                <?php case  'Programming': ?>
                                    <i class="fas fa-code"></i>
                                    <?php break; ?>
                                <?php case  'Politics': ?>
                                    <i class="fas fa-landmark"></i>
                                    <?php break; ?>
                                <?php default: ?>
                                    <i class="fas fa-otter"></i> 
                                    <?php break; ?>
                                    
                            <?php endswitch ?>
                            {{$thread->topic}}
                            </span>
                        </div>
                    </div>

            </li>
        </a>
    @endforeach
</ul>
@endsection