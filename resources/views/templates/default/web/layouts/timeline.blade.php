<!DOCTYPE html>
<html lang="en">
<head>

  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  
  <title>Ipu Paraguay - Timeline</title>
  <link rel="stylesheet" href="{{ url('/static/libs/jQueryTimerline/css/style.css') }}">
  {{-- <link rel="stylesheet" href="css/style.css" media="screen" /> --}}
  
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script> --}}
  <script src="{{ url('/static/libs/jQueryTimerline/js/jquery.timelinr-0.9.7.js') }}"></script>
  {{-- <script src="js/jquery.timelinr-0.9.7.js"></script> --}}
  <script>
    $(function(){
      $().timelinr({
        arrowKeys: 'true'
      })
    });1
  </script>

  <style>
  .logo {
    display: flex;
    align-items: center;
    padding-top: 5px;
    padding-bottom: 0px;
    justify-content: center;
}

  .logo div {
    width: 100px;
    height: 100px;
}
  </style>

</head>
<body>
  <header class="logo">
      <img src="{{url('/static/images/logo.png')}}"   width="200" height="200">
  </header>

  <section>
    <h3>{{$timelineProfile->name}}</h3>
  </section>
    
  
  
  <div id="timeline">
    <ul id="dates">
      @foreach ($timelines as $timeline)
        <li><a href="#{{$timeline->slug}}">{{ Carbon\Carbon::parse($timeline->date)->format('Y') }}</a></li>
      @endforeach
    </ul><ul id="issues">
      @foreach ($timelines as $timeline)
      <li id="{{$timeline->slug}}">
        <a href="{{'/uploads/'.$timeline->file_path.'/t_'.$timeline->image}}" data-fancybox="gallery">
          <img src="{{'/uploads/'.$timeline->file_path.'/t_'.$timeline->image}}" width="256" height="256">
        </a>
        <h1>{{ Carbon\Carbon::parse($timeline->created_at)->format('d') }} - {{ Carbon\Carbon::parse($timeline->date)->subMonth()->formatLocalized('%B')}}</h1>
        <p>{!! html_entity_decode($timeline->description) !!}</p>
      </li>
      @endforeach
    </ul>
    
    <div id="grad_left"></div>
    <div id="grad_right"></div>
    <a href="#" id="next">+</a>
    <a href="#" id="prev">-</a>
    
  </div>
  
  {{-- <h1>CSSLab.cl - jQuery Timelinr - Horizontal <a href="http://www.csslab.cl/2011/08/18/jquery-timelinr/" title="Volver al artículo original">[Volver/Back]</a></h1>
  <h2>&copy; 2011 CSSLab.cl</h2> --}}

</body>
</html>