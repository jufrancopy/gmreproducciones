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
         
        <img src="{{url('/static/images/header_email.jpg')}}" style="width:100%; display:block;">
        
        <div 
            style="background-color: #fff;
            padding:24px;">
            @yield('content')
        </div>
    </div>
</body>

</html>