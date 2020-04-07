@extends('../layouts.welcome')
@section('title')
<title>{{$thread->title}}</title>
@endsection
@section('content')
<div class="card my-3" id="threads">
        <div class="card-header bg-myblue">
            <div class="card-title">
                {{$thread->title}}
            </div>
        </div>
        <div class="card-body">
            <h6>{{$thread->subtitle}}</h6>
            <div>
                <p>{{$thread->description}}</p>
            </div>
            @if(($thread->code != null) &&(strlen($thread->code)>0)) 
                <div class="code p-3">{{$thread->code}} </div>
            @endif
        </div>
        <div class="row">
            <div class="col-8">
                <span class="ml-4" style="font-size: 8pt; font-weight:bold">{{count($thread->comments)}} comments - {{count($thread->likes)}} likes - 
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
            <?php 
                 $positive = 0;
                 $negative = 0;
                 $user_like = 0;
                 $user_dislike = 0;
                 foreach($thread->likes as $like) {
                     if($like->like ==1) {
                         if(!Auth::guest()) {
                             if(Auth::user()->id == $like->user_id) {
                                 $user_like = 1;
                             }
                         }
                         $positive += 1;
                     }
                     else {
                         if(!Auth::guest()) {
                             if(Auth::user()->id == $like->user_id) {
                                 $user_dislike = 1;
                             }
                         }
                         $negative +=1;
                     }
                 }
            ?>
            <div class="col-4 d-flex justify-content-end">
            @if($user_like == 1)
                <i id='like' data-comment-id="{{$thread->id}}" data-val="1" class='fas fa-thumbs-up mr-1 like' style="color:blue" ></i><span id='num_likes' data-val="{{$positive-1}}" class='mr-3'>{{$positive}}</span>
            @else
                <i id='like' data-comment-id="{{$thread->id}}" data-val="0" class='fas fa-thumbs-up mr-1 like' ></i><span id='num_likes' data-val="{{$positive}}" class='mr-3'>{{$positive}}</span>
            @endif
            @if($user_dislike==1) 
                <i id='dislike' data-comment-id="{{$thread->id}}" data-val="1" class='fas fa-thumbs-down mr-1 dislike' style="color:blue"></i><span id='num_dislikes' class="mr-3"data-val="{{$negative-1}}">{{$negative}}</span>
            @else
                <i id='dislike' data-comment-id="{{$thread->id}}" data-val="0" class='fas fa-thumbs-down mr-1 dislike'></i><span id='num_dislikes' class="mr-3" data-val="{{$negative}}">{{$negative}}</span>
            @endif
            </div>
        </div>
            
        
        
    </div>
    <form>
        <input type="hidden" value="{{$thread->id}}" name="thread_id" />
        @if(Auth::guest())
        <input id = "id" type="hidden" value="none" name="user_id" />
        @else
        <input id = "id" type="hidden" value="{{Auth::user()->id}}" name="user_id" />
        <input id = "id" type="hidden" value="{{Auth::user()->name}}" name="user_name" />
        <input id = "id" type="hidden" value="{{Auth::user()->username}}" name="user_username" />
        @endif
        <div class="form-row">
            <div class="form-group col-12">
                
                <textarea name="comment" rows="3" type="text" id="comment" class="form-control" placeholder="Adicione um comentário"></textarea>
                <span style="font-size:10pt; color:red" id="warning"></span>
            </div>
            <div class="form-group d-flex justify-content-end ml-auto">
                <button id="btn-cancel"  class="btn btn-light mr-2">CANCEL</button>
                @if(Auth::guest())
                <a href="{{route('home')}}"  class="btn btn-primary mr-2">COMMENT</a>
                @else
                <button id="btn-submit"  class="btn btn-primary mr-2">COMMENT</button>
                @endif
            </div>
        </div>
    </form>
    <div>
        <div id="comments">
        @foreach($thread->comments as $comment)
            <?php 
                $positive = 0;
                $negative = 0;
                $user_like = 0;
                $user_dislike = 0;
                foreach($comment->likes as $like) {
                    if($like->like ==1) {
                        if(!Auth::guest()) {
                            if(Auth::user()->id == $like->user_id) {
                                $user_like = 1;
                            }
                        }
                        $positive += 1;
                    }
                    else {
                        if(!Auth::guest()) {
                            if(Auth::user()->id == $like->user_id) {
                                $user_dislike = 1;
                            }
                        }
                        $negative += 1;
                    }
                }
            ?>
            <div class='container my-2 comments'> 
                <div class='row'>
                    <div class='col-1'>
                        <h2><span class='badge badge-secondary rounded-circle'>{{$comment->user->name[0]}}</span></h2>
                    </div>
                    <div class='col-lg-9 col-md-8'>
                        <span><span style= 'font-weight:bold; font-size:10pt'>{{$comment->user->username}}</span>
                        <span style='font-size:10pt'> 1 week ago </span></span><br />
                        <span>{{$comment->comment}}</span>
                    </div>
                    <div class='col-lg-2 col-md-3 mt-4'>
                        @if($user_like == 1)
                            <i id='like{{$comment->id}}' data-comment-id="{{$comment->id}}" data-val="1" class='fas fa-thumbs-up mr-1 like' style="color:blue" ></i><span id='num_likes{{$comment->id}}' data-val="{{$positive-1}}" class='mr-3'>{{$positive}}</span>
                        @else
                            <i id='like{{$comment->id}}' data-comment-id="{{$comment->id}}" data-val="0" class='fas fa-thumbs-up mr-1 like' ></i><span id='num_likes{{$comment->id}}' data-val="{{$positive}}" class='mr-3'>{{$positive}}</span>
                        @endif
                        @if($user_dislike==1) 
                            <i id='dislike{{$comment->id}}' data-comment-id="{{$comment->id}}" data-val="1" class='fas fa-thumbs-down mr-1 dislike' style="color:blue"></i><span id='num_dislikes{{$comment->id}}' data-val="{{$negative-1}}">{{$negative}}</span>
                        @else
                            <i id='dislike{{$comment->id}}' data-comment-id="{{$comment->id}}" data-val="0" class='fas fa-thumbs-down mr-1 dislike'></i><span id='num_dislikes{{$comment->id}}' data-val="{{$negative}}">{{$negative}}</span>
                        @endif
                        @if(!Auth::guest())
                            @if((Auth::user()->id == $comment->user->id) || (Auth::user()->id == $thread->user->id))
                            <a href="{{route('comment.destroy',['id' => $comment->id])}}"><span>X</span></a>
                            @endif
                        @endif
                    </div>
                </div>
            </div>
            @endforeach
        </div>   
    </div>
@endsection
@section('script')
<script type="text/javascript">

     $.ajaxSetup({

        headers: {

            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

        }

    });


   $("#btn-cancel").click(function(e) {
       e.preventDefault()
       $("#comment").val('')
   });



    $("#btn-submit").click(function(e){

  

        e.preventDefault();

   

        var thread_id = $("input[name=thread_id]").val();

        var user_id = $("input[name=user_id]").val();

        var user_name = $("input[name=user_name]").val();

        var user_username = $("input[name=user_username]").val();

        var comment = $("textarea[name=comment]").val();

        if (!(/\S/.test(comment))) {
            $("#comment").addClass("border border-danger")
            $("#warning").html("Write Something");
        }
        else {
            $("#comment").removeClass("border border-danger")
            $("#warning").html("");
            var comments_number = parseInt($("#commentsnumber").text()) + 1
            $("#commentsnumber").html(comments_number + ' comments')
            $.ajax({

            type:'POST',

            url:'/comment/',

            data:{thread_id:thread_id, user_id:user_id, comment:comment},

            success:function(data){
            $("#comment").val('')
            comments = "<div class='container my-2 comments'>" +
                                    "<div class='row'>"+
                                        "<div class='col-1'>"+
                                            "<h2><span class='badge badge-secondary rounded-circle'>"+user_name[0]+"</span></h2>"+
                                        "</div>"+
                                        "<div class='col-lg-9 col-md-8'>" +
                                            "<span><span style= 'font-weight:bold; font-size:10pt'>" + user_username +"</span>"+
                                            "<span style='font-size:10pt'> Just now </span></span><br />"+
                                            "<span>"+comment+"</span>"+
                                        "</div>"+
                                        "<div class='col-lg-2 col-md-3 mt-4'>"+
                                            "<i id='like"+data['id']+"' data-val = '0' data-comment-id='"+data['id']+"' class='fas fa-thumbs-up mr-1 like'></i><span id='num_likes"+data['id']+"' data-val='0' class='mr-3'>0</span>"+
                                            "<i id='dislike"+data['id']+"' data-val='0' data-comment-id='"+data['id']+"' class='fas fa-thumbs-down mr-1 dislike'></i><span id='num_dislikes"+data['id']+"' data-val='0' >0</span>"+
                                        "</div>"+
                                    "</div>"+
                                "</div>"
            $("#comments").prepend(comments)

            }

            });
        }
    });

    
    

    $("#like").click(function(e) {
        e.preventDefault()
        const thread_id= $(this).attr('data-comment-id')
        const val = $(this).attr('data-val')
        if((val == "1") || (val==1 )) {
            delete_like_thread(thread_id)
            $("#like").addClass("likes")
            $("#like").css("color","black")
            $("#like").attr("data-val","0")
            $("#num_likes").html(parseInt($("#num_likes").attr('data-val')))
        }
        else {
            $.ajax({

            type:'PUT',

            url:'/thread/like/'+thread_id,

            success:function(data){
                const { success } = data
                if(success == 0) {
                    window.location.href = '/home'
                }
                else {
                    
                    console.log(id)
                    $("#like").css("color","blue")
                    $("#dislike").css("color","black")
                    $("#like").attr("data-val","1")
                    $("#num_likes").html(parseInt($("#num_likes").attr('data-val'))+1)
                    if($("#dislike").attr('data-val') == "1") {
                    $("#num_dislikes").html(parseInt($("#num_dislikes").attr('data-val')))
                    $("#dislike").attr('data-val','0')
                    }

                }
                

            }

            });
        }
    });

    $("#dislike").click(function(e) {
        e.preventDefault()
        const thread_id= $(this).attr('data-comment-id')
        const val = $(this).attr('data-val')
        if((val == "1") || (val==1 )) {
            delete_like_thread(thread_id)
            $("#dislike").addClass("dislikes")
            $("#dislike").css("color","black")
            $("#dislike").attr("data-val","0")
            $("#num_dislikes").html(parseInt($("#num_dislikes").attr('data-val')))
        }
        else {
            $.ajax({

            type:'PUT',

            url:'/thread/dislike/'+thread_id,

            success:function(data){
                const { success } = data
                if(success == 0) {
                    window.location.href = '/home'
                }
                else {
                    
                    console.log(id)
                    $("#dislike").css("color","blue")
                    $("#like").css("color","black")
                    $("#dislike").attr("data-val","1")
                    $("#num_dislikes").html(parseInt($("#num_dislikes").attr('data-val'))+1)
                    if($("#like").attr('data-val') == "1") {
                    $("#num_likes").html(parseInt($("#num_likes").attr('data-val')))
                    $("#like").attr('data-val','0')
                    }

                }
                

            }

            });
        }
    })

    function delete_like_comment(comment_id) {
        $.ajax({

        type:'DELETE',

        url:'/comment/like/'+comment_id,

        success:function(data) {
            return;
        }
        });
    }

    function delete_like_thread(comment_id) {
        $.ajax({

        type:'DELETE',

        url:'/thread/like/'+comment_id,

        success:function(data) {
            return;
        }
        });
    }
    // $('#comments').on("click",".dislike", function() {
    //     const comment_id= $(this).attr('data-comment-id')
    //     $.ajax({

    //         type:'PUT',

    //         url:'/comment/dislike/'+comment_id,

    //         success:function(data){

    //             const { success } = data
    //             if(success == 0) {
    //                 window.location.href = '/home'
    //             }
    //             else {
    //                 startcomments()
    //             }

    //         }

    //     });
    // });

</script>
@endsection

