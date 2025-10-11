<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Lisa-Marie">
    <meta name="keywords" content="jiris">
    <title>Modifier le Jiri</title>
</head>
<body>
@if ($jiri)
    <h1>Modifier le Jiri : {{$jiri->name}}</h1>

    <form action='{{route('jiris.update', $jiri->id)}}' method="post">
        @csrf
        @method('PATCH')
        <fieldset class="jiri_section">
            <legend>
                {{__('labels-buttons.legend_jiri')}}
            </legend>
            <div class="field">
                <div class="text_field">
                    <label for="name">{{__('labels-buttons.name')}}</label>
                    <input type="text" name="name" id="name" value="{{$jiri->name}}">
                </div>
                <div class="text_field">
                    <label for="date">{{__('labels-buttons.date')}}</label>
                    <input type="date" name="date" id="date" value="{{$jiri->date}}">
                </div>
                <div class="textarea_field">
                    <label for="description">
                        {{__('labels-buttons.description')}}
                    </label>
                    <textarea name="description" >{{$jiri->description ?? ""}}</textarea>
                </div>
            </div>
        </fieldset>
        <fieldset class="contact_section">
            <legend>
                {{__('labels-buttons.legend_contacts')}}
            </legend>
            <div class="field">
                {{--            @foreach($contacts as $contact)
                                <label for="contact_name">{!! $contact->name !!}</label>
                                <input type="checkbox" id="contact_name" name="$contacts[]">
                            @endforeach--}}
                <div class="single_contact">
                    <label for="contact_name">Anika</label>
                    <input type="checkbox" id="contact_name" name="contacts[1]" {{old('checked' ?? "")}}>
                    <select name="contacts[1][role]">
                        @foreach(\App\Enums\ContactRoles::cases() as $role)
                            <option value="{{$role->value}}">{{$role->value}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="single_contact">
                    <label for="contact_name">Lucas</label>
                    <input type="checkbox" id="contact_name" name="contacts[2]" {{old('checked' ?? "")}}>
                    <select name="contacts[2][role]">
                        @foreach(\App\Enums\ContactRoles::cases() as $role)
                            <option value="{{$role->value}}">{{$role->value}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="single_contact">
                    <label for="contact_name">Elisa</label>
                    <input type="checkbox" id="contact_name" name="contacts[3]" {{old('checked' ?? "")}}>
                    <select name="contacts[3][role]">
                        @foreach(\App\Enums\ContactRoles::cases() as $role)
                            <option value="{{$role->value}}">{{$role->value}}</option>
                        @endforeach
                    </select>
                </div>

            </div>
        </fieldset>
        <fieldset class="project_section">
            <legend>
                {{__('labels-buttons.legend_projects')}}
            </legend>
            <div class="field">
                {{--        @foreach($projects as $project)
                        @endforeach--}}
                <div class="single_project">
                    <label for="project_name">CV</label>
                    <input type="checkbox" id="project_name" name="projects[1]" value="1" {{old('checked' ?? "")}}>
                </div>
                <div class="single_project">
                    <label for="project_name">Portfolio</label>
                    <input type="checkbox" id="project_name" name="projects[2]" value="2" {{old('checked' ?? "")}}>
                </div>
                <div class="single_project">
                    <label for="project_name">Client</label>
                    <input type="checkbox" id="project_name" name="projects[3]" value="3" {{old('checked' ?? "")}}>
                </div>
            </div>
        </fieldset>
        <button type="submit">
            {{__('labels-buttons.modify_a_jiri')}}
        </button>
    </form>


@else
    <h1><em>Il n’y a pas de Jiris à modifier</em></h1>
@endif


</body>
</html>
