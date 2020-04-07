<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @yield('title')
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">
    <link rel="stylesheet" href="{{asset ('site/bootstrap.css')}}"></link>
    <link rel="stylesheet" href="{{asset ('site/style.css')}}"></link>
    <script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <script src="{{asset ('site/jquery.js') }}"></script>
    <script src="{{asset ('site/bootstrap.js') }}"></script>
</head>
<body>

<nav class="navbar fixed-top navbar-inverse navbar-expand-md navbar-light bg-myblue p-0" id="menu1">
    <div class="container">
        <a class="navbar-brand h1 mb0" href="/">Forum</a>
        <button id="min" class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSite">
            <span class="navbar-toggler-icon navbar-light"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSite">
            <ul class="navbar-nav ml-auto">
                @if(Auth::guest())
                <li class="nav-item " id = "last-item">
                    <a class="nav-link" href="{{route('home')}}">SIGN IN</a>
                </li>
                @else
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        {{ Auth::user()->name }} <span class="caret"></span>
                    </a>

                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </li>
                @endif
           
            </ul>
        </div>
        </div>
</nav>
<div class="container mt-10 full-height">
    <div class="row full-height">
    <nav class="col-md-2 d-none d-lg-block mt-3 navigation" >
            <div class="sidebar-sticky">
                <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link active" href="/">
                    Home 
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="{{route('welcome.filter', ['topic' => 'Sports'])}}">
                    Sports <span class="sr-only"></span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('welcome.filter', ['topic' => 'Politcs'])}}">
                    <span data-feather="file"></span>
                    Politcs
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('welcome.filter', ['topic' => 'Health'])}}">
                    Health
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('welcome.filter', ['topic' => 'Programming'])}}">
                    Programming
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('welcome.filter', ['topic' => 'Games'])}}">
                    Games
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('welcome.filter', ['topic' => 'Economy'])}}">
                    Economy
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('welcome.filter', ['topic' => 'Others'])}}">
                    Others
                    </a>
                </li>
                </ul>
            </div>
         </nav>

        <div class="col-lg-8 col-sm-12 mt-1 border-left border-right mt-2 full-height">
        @yield('content')
        </div>
        <nav class="col-md-2 d-none d-lg-block mt-3 navigation">
            <div class="sidebar-sticky">
                <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link active" href="{{route('thread.create')}}">
                    <span data-feather="thread"></span>
                    Create a thread
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('home')}}">
                    <span data-feather="home"></span>
                    My profile
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">
                    <span data-feather="shopping-cart"></span>
                    Products
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">
                    <span data-feather="users"></span>
                    Customers
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">
                    <span data-feather="bar-chart-2"></span>
                    Reports
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">
                    <span data-feather="layers"></span>
                    Integrations
                    </a>
                </li>
                </ul>
            </div>
         </nav>
    </div>
</div>
</body>
@yield('script')
</html>


<script>

var elementPosition = $('.navigation').offset();
console.log(elementPosition)
$(window).scroll(function(){
    var scroll = $(window).scrollTop();
         if(scroll > 0){
              $('.navigation').css('margin-top',scroll+16+'px');
              $('.navigation').removeClass('mt-3')
         } else {
             $('.navigation').css('position','relative');
             $('.navigation').addClass('mt-3')
         }    
});

$('#comments').on("click",".like", function() {
        const comment_id= $(this).attr('data-comment-id')
        const id= $(this).attr('id')
        const val = $(this).attr('data-val')
        console.log(val)
        console.log(id)
        console.log(comment_id)
        console.log(parseInt($("#num_likes"+comment_id).attr('data-val')))
        if((val == "1") || (val==1 )) {
            delete_like_comment(comment_id)
            $("#"+id).addClass("like")
            $("#"+id).css("color","black")
            $("#"+id).attr("data-val","0")
            $("#num_likes"+comment_id).html(parseInt($("#num_likes"+comment_id).attr('data-val')))
        }
        else {
            $.ajax({

            type:'PUT',

            url:'/comment/like/'+comment_id,

            success:function(data){
                const { success } = data
                if(success == 0) {
                    window.location.href = '/home'
                }
                else {
                    
                    console.log(id)
                    $("#"+id).css("color","blue")
                    $("#dis"+id).css("color","black")
                    $("#"+id).attr("data-val","1")
                    $("#num_likes"+comment_id).html(parseInt($("#num_likes"+comment_id).attr('data-val'))+1)
                    if($("#dis"+id).attr('data-val') == "1") {
                    $("#num_dislikes"+comment_id).html(parseInt($("#num_dislikes"+comment_id).attr('data-val')))
                    $("#dis"+id).attr('data-val','0')
                    }

                }
                

            }

            });
        }
        
    }); 

    $('#comments').on("click",".dislike", function(e) {
        $(this).css('point-events','none')
        const comment_id= $(this).attr('data-comment-id')
        const id= $(this).attr('id')
        const val = $(this).attr('data-val')
        console.log(val)
        console.log(id)
        if((val == "1") || (val==1 )) {
            delete_like_comment(comment_id)
            $("#"+id).css("color","black")
            $("#"+id).attr("data-val","0")
            $("#num_dislikes"+comment_id).html(parseInt($("#num_dislikes"+comment_id).attr('data-val')))
        }
        else {
            $.ajax({

            type:'PUT',

            url:'/comment/dislike/'+comment_id,

            success:function(data){
                const { success } = data
                if(success == 0) {
                    window.location.href = '/home'
                }
                else {
                    
                    console.log(id)
                    $("#"+id).css("color","blue")
                    $("#"+id.substring(3)).css("color","black")
                    $("#"+id).attr("data-val","1")
                    $("#num_dislikes"+comment_id).html(parseInt($("#num_dislikes"+comment_id).attr('data-val'))+1)
                    if($("#"+id.substring(3)).attr('data-val') == "1") {
                     $("#num_likes"+comment_id).html(parseInt($("#num_likes"+comment_id).attr('data-val')))
                    $("#"+id.substring(3)).attr('data-val','0')
                     
                    }
                }
                

            }

            });
        }
        $(this).css('point-events','auto')
        
    }); 

</script>