<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Lisa-Marie">
    <meta name="keywords" content="jiris">
    <title>Détail du Jiri</title>
</head>
<body>
@if ($jiri)
    <h1>Détail du Jiri : {{$jiri->name}}</h1>
    <ol>
            <li>
                <a href="/jiris/{{ $jiri->id }}/edit">
                    {!!$jiri->name;!!}
                </a>
            </li>
    </ol>
@else
    <h1><em>Il n’y a pas de Jiris </em></h1>
@endif


</body>
</html>
