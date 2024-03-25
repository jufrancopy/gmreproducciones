<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body style="
    margin: 10px; 
    padding: 0px; 
    background-color: #f3f3f3;
    ">
    <div style="
        display:block;
        width:60%;
        margin:0px auto; 
        max-width:728px;">

        <div style="
            background-color: #5f5a5a;
            display: flex;
            justify-content: center;
            ">
            <img src="{{url('/static/images/Logo_GMRE-03.png')}}" style="
                width:100px;
                height:50%;
                display:block;
                ">
        </div>

        <div style="
            background-color: #fff;
            padding:24px;">
            @yield('content')
            <div style="margin-top:16px">
                <p>Encuentranos en las siguientes redes sociales</p>
                @if(Config('configSite.social_facebook') != "")
                <a href="{{Config('configSite.social_facebook')}}">
                    <img src="{{url('/static/images/iconos/facebook.png')}}" style="width:36px; margin-right:6px">
                </a>
                @endif

                @if(Config('configSite.social_instagram') != "")
                <a href="{{Config('configSite.social_facebook')}}">
                    <img src="{{url('/static/images/iconos/instagram.png')}}" style="width:36px">
                </a>
                @endif

                @if(Config('configSite.social_twitter') != "")
                <a href="{{Config('configSite.social_twitter')}}">
                    <img src="{{url('/static/images/iconos/twitter.png')}}" style="width:36px">
                </a>
                @endif

                @if(Config('configSite.social_youtube') != "")
                <a href="{{Config('configSite.social_youtube')}}">
                    <img src="{{url('/static/images/iconos/youtube.png')}}" style="width:36px">
                </a>
                @endif

                @if(Config('configSite.social_whatsapp') != "")
                <a href="{{Config('configSite.social_whatsapp')}}">
                    <img src="{{url('/static/images/iconos/whatsapp.png')}}" style="width:36px">
                </a>
                @endif
            </div>
        </div>
    </div>
</body>

</html>