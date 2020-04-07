<nav class="navbar bg-myblue fixed-top navbar-inverse navbar-expand-md p-0" id="menu1">
    <div class="container">
        <a class="navbar-brand h1 mb0" href="#">Forum</a>
        <button id="min" class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSite">
            <span class="navbar-toggler-icon navbar-light"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSite">
            <ul class="navbar-nav">
                <li class="nav-item ml-auto">
                    <form>
                        <div class="form-row">
                            <div class="form-group col-12">
                                <input class="form-control" type="text" name="search" />
                            </div>
                        </div>
                        
                    </form>
                </li>
                @if(Auth::guest())
                <li class="nav-item ml-auto" id = "last-item">
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