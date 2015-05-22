<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{{$settings['title']}}</title>
    <meta name="description" content="{{$settings['description']}}"/>
</head>
<body class="{{join(' ', $bodyClasses)}}">

@if($authUser)
    <h2>Logged in as: {{$authUser->email}}</h2>
@endif

@yield('content')

</body>
</html>
