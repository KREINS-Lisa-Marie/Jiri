<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Lisa-Marie">
    <meta name="keywords" content="jiris">
    <title>Liste des projets</title>
</head>
<body>
@if ($projects->isNotEmpty())
    <h1>liste des projets</h1>
    <ol>
        @foreach ($projects as $project)

            <li>
                <a href="/projects/{{ $project->id }}">
                    {!!$project->name;!!}
                </a>
            </li>

        @endforeach
    </ol>
@else
    <h1><em>Il n’y a pas de projets </em></h1>
@endif


</body>
</html>
