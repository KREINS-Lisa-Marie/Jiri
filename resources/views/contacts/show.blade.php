<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Lisa-Marie">
    <meta name="keywords" content="jiris">
    <title>Liste du Contact</title>
</head>
<body>
@if ($contacts->isNotEmpty())
    @foreach ($contacts as $contact)
        <h1>Détail du Contact : {{$contact->id}}</h1>
        <ol>


            <li>
                <a href="/contacts/{{ $contact->id }}">
                    {!!$contact->name;!!}
                </a>
            </li>
        </ol>
    @endforeach
@else
    <h1><em>Il n’y a pas de Contact </em></h1>
@endif


</body>
</html>
