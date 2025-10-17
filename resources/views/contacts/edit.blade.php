<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Lisa-Marie">
    <meta name="keywords" content="jiris">
    <title>Modifier le Contact</title>
</head>
<body>
@if ($contact)
    <h1>Modifier le Contact : {{$contact->name}}</h1>

    <form action='{{route('contacts.update', $contact->id)}}' method="post">
        @csrf
        @method('PATCH')
        <fieldset class="contact_section">
            <legend>
                {{__('labels-buttons.legend_contacts')}}
            </legend>
            <div class="field">
                <div class="single_contact">
                    <label for="name">{{__('labels-buttons.name')}}</label>
                    <input type="text" id="name" name="name" value="{{$contact->name}}">
                    @error('name')
                    <p class="error text-red-500">
                        {{$message}}
                    </p>
                    @enderror
                </div>
                <div class="single_contact">
                    <label for="email">{{__('labels-buttons.email')}}</label>
                    <input type="email" id="email" name="email" value="{{$contact->email}}">
                    @error('email')
                    <p class="error text-red-500">
                        {{$message}}
                    </p>
                    @enderror
                </div>
                <div class="single_contact">
                    <label for="avatar">{{__('labels-buttons.avatar')}}</label>
                    <input type="file" id="avatar" name="avatar" >
                    @error('avatar')
                    <p class="error text-red-500">
                        {{$message}}
                    </p>
                    @enderror
                </div>

            </div>
        </fieldset>
        <button type="submit">
            {{__('labels-buttons.modify_a_contact')}}
        </button>
    </form>

@else
    <h1><em>Il n’y a pas de Contact à modifier</em></h1>
@endif


</body>
</html>
