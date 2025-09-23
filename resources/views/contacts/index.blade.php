<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Lisa-Marie">
    <meta name="keywords" content="jiris">
    <title>Liste des Contactes</title>
</head>
<body>
@if ($contacts->isNotEmpty())
    <h1>liste des contactes</h1>
    <ol>
        @foreach ($contacts as $contact)

            <li>
                <a href="/contacts/{{ $contact->id }}">
                    {!!$contact->name;!!}
                </a>
            </li>

        @endforeach
    </ol>
@else
    <h1><em>Il n’y a pas de Contacte </em></h1>
@endif


</body>
</html>
