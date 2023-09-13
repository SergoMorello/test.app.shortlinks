<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Test app - short link</title>
		<link rel="stylesheet" href="{{asset(mix('css/app.css'))}}" type="text/css">
		<script type="text/javascript" src="{{asset(mix('js/app.js'))}}"></script>
	</head>
	<body>
		@yield('content')
	</body>
</html>
