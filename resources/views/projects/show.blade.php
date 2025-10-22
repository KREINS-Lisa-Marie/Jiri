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
        <div>
            <h2>Nom du projet :</h2>
            <p>{!!$project->name;!!}</p>
        </div>
        <br>
        <a href="{{ route('projects.edit', $project->id) }}">
            Modifier le projet
        </a>

@else
    <h1><em>Il n’y a pas de projets </em></h1>
@endif


</body>
</html>
