@component('layouts.app')
<body>
<main class="px-6 py-6 flex items-center flex-col ">
@if ($contact)
        <h1 class="font-bold text-4xl pb-20">{{__('contact.details_of_the_contact')}}{{$contact->name}}</h1>
        <ul class="my-15 bg-blue-50 rounded-2xl p-10">
            <li class="  font-bold">
                <p class="text-lg p-2">{{__('contact.name')}}</p>
                   <p class="font-normal">{!!$contact->name!!}</p>
            </li>
            <li  class="pt-4 font-bold">
                <p  class="text-lg p-2">{{__('contact.email')}}</p>
                    <p class="font-normal">{!!$contact->email!!}</p>
            </li>
            @if(isset($contact['avatar']))
                <li class="pt-4 font-bold" >
                    <p  class="text-xl font-bold ">{{__('contact.avatar')}}</p>
                        <img
                            src="{{ asset('/images/contacts/variants/300x300/'.$contact->avatar) }}"
                            alt="Avatar de {!! $contact->name !!}" class="max-w-xs rounded-2xl mt-8">
                </li>
            @endif

            {{--<li  class="pt-4 pl-4">
                <p  class="text-xl font-bold ">{{__('contact.avatar')}}</p>
                <img src="{!! asset('storage/app/public/images/contacts/originals'.$contact->avatar) !!}" alt="L’avatar de {!! $contact->name !!}">
            </li>--}}
        </ul>
        <a href="/contacts/{{ $contact->id }}/edit" class="text-white font-bold px-10 py-5 shadow-xl bg-cyan-700  rounded-2xl">
            Modifier le contact
        </a>

@else
    <h1><em>Il n’y a pas de Contact </em></h1>
@endif
</main>
</body>
@endcomponent
