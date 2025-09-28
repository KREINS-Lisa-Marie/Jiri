{{--
<!doctype html>
<html lang="{!! app()->getLocale(); !!}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Lisa-Marie">
    <meta name="keywords" content="jiris">
    <title>Création d'un Jiri</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="p-6">
<h1 class="font-bold text-center">
    {!! __('headings.create_a_jiri') !!}
</h1>
<form action="{!! route('jiris.store') !!}" method="post">
    @csrf
    <div class="flex flex-col relative">
        <label for="name">
            Name <small>(Requis)</small>
        </label>
        @error('name')
        <p>
            {!! $message !!}
        </p>
        @enderror
        <input type="text" id="name" name="name" value="{{ old(__('validation.name')) }}">
    </div>
    <div class="flex flex-col relative">
        <label for="date">
            Date <small>(Requis)</small>
        </label>
        @error('date')
        <p>
            {!! $message !!}
        </p>
        @enderror
        <input type="text" id="date" name="date" value="{{ old('date') }}" class="border">
    </div>
    <div class="flex flex-col relative">
        <label for="description">
            __('validation.description')
        </label>
        @error('description')
        <p>
            {!! $message !!}
        </p>
        @enderror
        <input type="text" id="description" name="description" value="{{ old('description') }}">
    </div>
    <button type="submit" class="flex flex-col relative">
        __('labels-buttons.create_a_jiri')
    </button>
</form>
</body>
</html>
--}}


    <!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Lisa-Marie">
    <meta name="keywords" content="jiris">
    <title>Création d'un Jiri</title>
</head>
<body>
<h1>
    {{__('headings.create_a_jiri')}}
</h1>
<form action="{!! route('jiris.store') !!}" method="post">
    @csrf
    <fieldset class="jiri_section">
        <legend>
            {{__('labels-buttons.legend_jiri')}}
        </legend>
        <div class="field">
            <div class="text_field">
                <label for="name">{{__('labels-buttons.name')}}</label>
                <input type="text" name="name" id="name">
            </div>
            <div class="text_field">
        <label for="date">{{__('labels-buttons.date')}}</label>
        <input type="date" name="date" id="date">
                </div>
            <div class="textarea_field">
        <label for="description">
            {{__('labels-buttons.description')}}
        </label>
        <textarea name="description"></textarea>
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
                <input type="checkbox" id="contact_name" name="contacts[1]">
                <select name="contacts[1][role]">
                    @foreach(\App\Enums\ContactRoles::cases() as $role)
                        <option value="{{$role->value}}">{{$role->value}}</option>
                    @endforeach
                </select>
            </div>
            <div class="single_contact">
                <label for="contact_name">Lucas</label>
                <input type="checkbox" id="contact_name" name="contacts[2]">
                <select name="contacts[2][role]">
                    @foreach(\App\Enums\ContactRoles::cases() as $role)
                        <option value="{{$role->value}}">{{$role->value}}</option>
                    @endforeach
                </select>
            </div>
            <div class="single_contact">
                <label for="contact_name">Elisa</label>
                <input type="checkbox" id="contact_name" name="contacts[3]">
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
            <input type="checkbox" id="project_name" name="projects[1]" value="1">
        </div>
        <div class="single_project">
            <label for="project_name">Portfolio</label>
            <input type="checkbox" id="project_name" name="projects[2]" value="2">
        </div>
        <div class="single_project">
            <label for="project_name">Client</label>
            <input type="checkbox" id="project_name" name="projects[3]" value="3">
        </div>
    </div>
</fieldset>
    <button type="submit">
        {{__('labels-buttons.create_a_jiri')}}
    </button>
</form>
</body>
</html>
