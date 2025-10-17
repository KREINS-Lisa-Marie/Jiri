<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Lisa-Marie">
    <meta name="keywords" content="jiris">
    <title>Liste du projets</title>
</head>
<body>
@if ($project)

        <h1>Détail du Projet : {{$project->name}}</h1>
        <ol>


            <li>
                <a href="/projects/{{ $project->id }}">
                    {!!$project->name;!!}
                </a>
            </li>
        </ol>
@else
    <h1><em>Il n’y a pas de projets </em></h1>
@endif


</body>
</html>
