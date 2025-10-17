<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Lisa-Marie">
    <meta name="keywords" content="jiris">
    <title>Liste des Jiri</title>
</head>
<body>
@if ($jiris->isNotEmpty() && $user)
    <h1>liste des Jiris de {{$user->name}}</h1>
    <ol>
        @foreach ($user->jiris as $jiri)

            <li>
                <a href="/jiris/{{ $jiri->id }}">
                    {!!$jiri->name;!!}
                </a>
            </li>

        @endforeach
    </ol>
@else
    <h1><em>Il n’y a pas de Jiris </em></h1>
@endif


</body>
</html>
