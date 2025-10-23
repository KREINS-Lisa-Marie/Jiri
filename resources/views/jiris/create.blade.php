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

@component('layouts.app')
<body>

<main class="px-6 py-6 flex items-center flex-col ">
    <h1 class="font-bold text-4xl pb-20">
        {{__('headings.create_a_jiri')}}
    </h1>
    <form action="{!! route('jiris.store') !!}" method="post" class="bg-blue-50 rounded-2xl shadow-2xl p-10 min-w-2xl">
        @csrf
        <fieldset class="jiri_section pb-10">
      @component('components.form.legend')
                {{__('labels-buttons.legend_jiri')}}
            @endcomponent
            {{--      <legend class="text-3xl font-medium pl-2 pb-3">
                {{__('labels-buttons.legend_jiri')}}
            </legend>--}}
            <div class="field">
                <div class="text_field pb-5 flex flex-col">
                    <label for="name" class="font-bold pb-2">{{__('labels-buttons.name')}}</label>
                    <input type="text" name="name" id="name" placeholder="John Doe" value="{!! old('name') !!}" class="bg-white rounded-xl p-2">
                    @error('name')
                    <p class="error text-red-500">
                        {{$message}}
                    </p>
                    @enderror
                </div>
            {{--    <div class="text_field pb-5 flex flex-col">
                    <label for="date" class="font-bold pb-2">{{__('labels-buttons.date')}}</label>
                    <input type="date" name="date" id="date" placeholder="10/05/2025" value="{!! old('date') !!}" class="bg-white rounded-xl p-2">
                    @error('date')
                    <p class="error text-red-500">
                        {{$message}}
                    </p>
                    @enderror
                </div>--}}
                @component('components.fields.date', ['old_date' =>  old('date')])
                    {{__('labels-buttons.date')}}
                @endcomponent
             {{--   <div class="textarea_field pb-5 flex flex-col">
                    <label for="description" class="font-bold pb-2" >
                        {{__('labels-buttons.description')}}
                    </label>
                    <textarea id="description" name="description"
                              placeholder="Le Jury ... évalue..." class="bg-white rounded-xl p-2">{!! old('description') !!}</textarea>
                </div>--}}
                @component('components.fields.textarea', ['old_values' =>  old('description')])
                    {{__('labels-buttons.description')}}
                @endcomponent
            </div>
        </fieldset>
        <fieldset class="contact_section pb-10">
       {{--     <legend class="text-3xl font-medium pl-2 pb-3">
                {{__('labels-buttons.legend_contacts')}}
            </legend>--}}
            @component('components.form.legend')
                {{__('labels-buttons.legend_contacts')}}
            @endcomponent
            <div class="field">

                @foreach($contacts as $contact)
                    <div class="single_contact pb-4 flex gap-3">
                        <div class="label_checkbox pb-4 flex flex-row-reverse justify-end">
                            <label for="contacts{!! $contact->id !!}">{!! $contact->name !!}</label>
                            <input type="checkbox" name="contacts[{!! $contact->id !!}]"
                                   id="contact{!! $contact->id !!}"
                                   value="{!! $contact->id !!}"
                                   onchange="toggleRole(this)" class="mr-4"></div>
                        <select name="contacts[{!! $contact->id !!}][role]" id="role{!! $contact->id !!}" disabled class="bg-cyan-600 text-white p-2 rounded-2xl">
                            @foreach(\App\Enums\ContactRoles::cases() as $role)
                                <option value="{{$role->value}}" >{{$role->value}}</option>
                            @endforeach
                        </select>
                    </div>
                @endforeach

            </div>
        </fieldset>
        <fieldset class="project_section pb-10">
   {{--         <legend class="text-3xl font-medium pl-2 pb-3">
                {{__('labels-buttons.legend_projects')}}
            </legend>--}}
            @component('components.form.legend')
                {{__('labels-buttons.legend_projects')}}
            @endcomponent
            <div class="field">
                @foreach($projects as $project)
                    <div class="single_project pb-4 flex flex-row-reverse justify-end">
                        <label for="projects[{!! $project->id !!}]">{!! $project->name !!}</label>
                        <input type="checkbox" id="projects{!! $project->id !!}" name="projects[{!! $project->id !!}]"
                               value="{!! $project->id !!}" class="mr-4">
                    </div>
                @endforeach
                {{--<div class="single_project">
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
                </div>--}}
            </div>
        </fieldset>
   {{--     <button type="submit" class="text-white font-bold px-10 py-5 shadow-xl bg-cyan-700  rounded-2xl">
            {{__('labels-buttons.create_a_jiri')}}
        </button>--}}
        @component('components.button')
            {{__('labels-buttons.create_a_jiri')}}
        @endcomponent
    </form>
</main>

<script>
    // wird aufgerufen wenn onchange="toggleRole(this)" aufgerufen wird Immer wenn Kästchen anklickst oder abklickst
    function toggleRole(checkbox) {
        const contactId = checkbox.id.replace('contact', '');       // hier holt man id nummer von kontakt
        const roleSelect = document.getElementById('role' + contactId);  // select hat ID role4 bei Kontakt 4, //verbindet die Zahl mit "role" → role4.

        // aktivieren oder deaktivieren select, aktivieren select nur wenn checked
        roleSelect.disabled = !checkbox.checked;
    }
</script>
</body>

@endcomponent

{{--            @foreach($contacts as $contact)
    <label for="contact_name">{!! $contact->name !!}</label>
    <input type="checkbox" id="contact_name" name="$contacts[]">
@endforeach--}}
{{--

            <div class="single_contact">
                <label for="contact_name">{!! $contact->name !!}</label>
                <input type="checkbox" id="contact_name" name="contacts[1]">
                <select name="contacts[1][role]">
                    @foreach(\App\Enums\ContactRoles::cases() as $role)
                        <option value="{{$role->value}}">{{$role->value}}</option>
                    @endforeach
                </select>
            </div>
            <div class="single_contact">
                <label for="contact_name">{!! $contact->name !!}</label>
                <input type="checkbox" id="contact_name" name="contacts[2]">
                <select name="contacts[2][role]">
                    @foreach(\App\Enums\ContactRoles::cases() as $role)
                        <option value="{{$role->value}}">{{$role->value}}</option>
                    @endforeach
                </select>
            </div>
            <div class="single_contact">
                <label for="contact_name">{!! $contact->name !!}</label>
                <input type="checkbox" id="contact_name" name="contacts[3]">
                <select name="contacts[3][role]">
                    @foreach(\App\Enums\ContactRoles::cases() as $role)
                        <option value="{{$role->value}}">{{$role->value}}</option>
                    @endforeach
                </select>
            </div>--}}
