<!doctype html>
<html>

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<script src="https://code.jquery.com/jquery-3.3.1.min.js"
		integrity="sha384-tsQFqpEReu7ZLhBV2VZlAu7zcOV+rXbYlF2cqB8txI/8aZajjp4Bqd+V6D5IgvKT" crossorigin="anonymous">
	</script>
	<link rel="stylesheet" href="{{ url('/static/libs/Responsive-Timeline/css/style.css') }}">
	<link rel="stylesheet" href="{{ url('/static/libs/Responsive-Timeline/css/jquerysctipttop.css') }}">
	<link href="https://fonts.googleapis.com/css?family=Droid+Serif" rel="stylesheet">
	<title>Timeline Ipu Paraguay</title>
</head>

<body>

	<div class="jquery-script-clear">
	<h1 style="text-align: center; color: white; margin-top:150px">{{$timelineProfile->name}}</h1>
		<div class="timeLine">
			@foreach ($timelines as $timeline)
			<div class="row">
				<div class="lineHeader hidden-sm hidden-xs"></div>
				<div class="lineFooter hidden-sm hidden-xs"></div>
				<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 item">
					<div class="caption">
						<div class="star center-block">
							<span class="h3">{{ Carbon\Carbon::parse($timeline->date)->format('d') }}</span>
							<span>{{ Carbon\Carbon::parse($timeline->date)->formatLocalized('%b')}}</span>
							
							
							<span>{{ Carbon\Carbon::parse($timeline->date)->format('Y') }}</span>
						</div>
						<div class="image">
							<img src="{{'/uploads/'.$timeline->file_path.'/t_'.$timeline->image}}">
							<div class="title">
								<h2>{{$timeline->title}} <i class="fa fa-arrow-circle-right" aria-hidden="true"></i>
								</h2>
							</div>
						</div>
						<div class="textContent">
							<p class="lead">{!! html_entity_decode($timeline->description) !!}</p>
						</div>
					</div>
				</div>
			</div>
			@endforeach
		</div>
	</div>

	<script src="{{ url('/static/libs/Responsive-Timeline/js/timeLine.js') }}"></script>
	<script src="{{ url('/static/libs/Responsive-Timeline/js/script.js') }}"></script>
</body>

</html>