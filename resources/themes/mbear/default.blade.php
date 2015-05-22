<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{{$settings['title']}}</title>
    <meta name="description" content="{{$settings['description']}}"/>
</head>
<body class="{{join(' ', $bodyClasses)}}">

@if($me)
    <h2>Logged in as: {{$me->email}}</h2>
@endif

@yield('content')

</body>
</html>
