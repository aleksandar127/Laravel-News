<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
         <link href="/css/app.css" rel="stylesheet">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
         <script src="/js/app.js"></script>



<nav class="navbar navbar-expand-md navbar-dark bg-dark">
    <div class="navbar-collapse collapse w-100 order-1 order-md-0 dual-collapse2">
        <ul class="navbar-nav mr-auto">
        <li class="nav-item"><a class="nav-link" href="{{action('CurrencyController@index')}}">Currency</a></li>
                   <li class="nav-item"> <a class="nav-link" href="/weather">Weather</a></li>
                   <li class="nav-item"> <a class="nav-link" href="/article">News</a></li>
                    @auth
                     <li class="nav-item"><a class="nav-link" href="/myarticles">My Articles</a></li>
                       <li class="nav-item"> <a class="nav-link" href="/article/create">Create article</a></li>
                    @endauth

        </ul>
    </div>
    <div class="mx-auto order-0">
        <a class="navbar-brand mx-auto" href="/article">NEWS</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target=".dual-collapse2">
            <span class="navbar-toggler-icon"></span>
        </button>
    </div>
    <div class="navbar-collapse collapse w-100 order-3 dual-collapse2">
        <ul class="navbar-nav ml-auto">
             @inject('notification', 'notification')
             @guest
                <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">Login</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('register') }}">Register</a></li>
            @endguest
            @auth
                <li class="nav-item"><a class="nav-link" href="{{ route('logout') }}">Logout</a></li>

                <li class="nav-item"><a class="nav-link text-danger" id="count" onclick="show()" style="cursor: pointer;">New Articles {{$notification->count()}}</a></li>

             @endauth


        </ul>
    </div>
</nav>
<div  id="not" class="position-fixed" style="top:50px; right:0px; z-index: 10000;display:inline-block;float:right;">
    @if ($notification->count())
        @include('inc.notifications')
    @endif
</div>

<div class="w-50 p-3" style="margin:auto;">
    @include('inc.messages')
</div>

@yield('content')

<script>

    $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$(".closed").click(function(e){

    var id= $(this).parent('div').attr( "id" );
    $(this).parent('div').remove();

    $.ajax({

        type:'POST',

        url:'/ajax',

        data:{id:id},

        success:function(data){
            var count=$( '#count' ).html();
            count=count.substring(13);
            var sub=parseInt(count)-1;
            $( '#count' ).html('New Articles '+sub);

        }

    });

});

function show(){
   var els= document.getElementsByClassName('notification');
   Array.prototype.forEach.call(els, function(el) {
        if(el.style.display=='block')
            el.style.display='none';
        else
            el.style.display='block';

    });
}

</script>

    </body>
</html>
