<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Lisa-Marie">
    <meta name="keywords" content="jiris">
    <title>Liste des Jiri</title>
</head>
<body>
@if ($jiris->isNotEmpty())
    @foreach ($jiris as $jiri)
    <h1>Détail du Jiri : {{$jiri->id}}</h1>
    <ol>


            <li>
                <a href="/jiris/{{ $jiri->id }}">
                    {!!$jiri->name;!!}
                </a>
            </li>
    </ol>
    @endforeach
@else
    <h1><em>Il n’y a pas de Jiris </em></h1>
@endif


</body>
</html>
