@component('layouts.app')
<body>
<main class="px-6 py-6 flex items-center flex-col ">
@if ($contact)
    <h1 class="font-bold text-4xl pb-20">Modifier le Contact : {{$contact->name}}</h1>

    <form action='{{route('contacts.update', $contact->id)}}' method="post" class="bg-blue-50 rounded-2xl shadow-2xl p-10 min-w-2xl" enctype="multipart/form-data" >
        @method('PATCH')
        @csrf
        <fieldset class="contact_section">
            <div class="field">
                <div class="text_field pb-5 flex flex-col">
                    <label for="name" class="font-bold pb-2">{{__('labels-buttons.name')}}</label>
                    <input type="text" id="name" name="name" value="{{$contact->name}}" class="bg-white rounded-xl p-2">
                    @error('name')
                    <p class="error text-red-500">
                        {{$message}}
                    </p>
                    @enderror
                </div>
                <div class="text_field pb-5 flex flex-col">
                    <label for="email" class="font-bold pb-2">{{__('labels-buttons.email')}}</label>
                    <input type="email" id="email" name="email" value="{{$contact->email}}" class="bg-white rounded-xl p-2">
                    @error('email')
                    <p class="error text-red-500">
                        {{$message}}
                    </p>
                    @enderror
                </div>
                <div class="text_field pb-5 flex flex-col">
                    <input type="hidden" name="MAX_FILE_SIZE" value="30000000" />
                    <label for="avatar" class="font-bold pb-2">{{__('labels-buttons.avatar')}}</label>
                    <input type="file" id="avatar" name="avatar" class="bg-white rounded-xl p-2">
                    @error('avatar')
                    <p class="error text-red-500">
                        {{$message}}
                    </p>
                    @enderror
                </div>

            </div>
        </fieldset>
     {{--   <button type="submit" class="text-white font-bold px-10 py-5 shadow-xl bg-cyan-700  rounded-2xl hover:bg-cyan-600 focus:outline-none focus:ring-2 focus:bg-cyan-600 focus:ring-offset-2 ">
            {{__('labels-buttons.modify_a_contact')}}
        </button>--}}

        @component('components.button')
            {{__('labels-buttons.modify_a_contact')}}
        @endcomponent
    </form>

@else
    <h1><em>Il n’y a pas de Contact à modifier</em></h1>
@endif

</main>
</body>
@endcomponent
