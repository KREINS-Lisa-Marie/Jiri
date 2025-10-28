@component('layouts.app')
<body class="">
<div class="px-6 py-6 flex items-center flex-col">
@if ($contacts->isNotEmpty())
    <h1 class="font-bold text-4xl pb-20">
    {{__('contact.contact_list')}}
    </h1>

   <table class="px-4 mt-4 shadow-xl rounded-2xl mb-10">
       <thead class="bg-cyan-700 text-white ">
       <tr>
           <th scope="col" class="text-lg p-2 rounded-tl-2xl">
               <a href="{{ route('contacts.index', ['sort' => 'name', 'order' => $sort === 'name' && $order === 'asc' ? 'desc' : 'asc']) }}">
                   {{__('contact.complete_name')}}
                   @if ($sort === 'name')
                       {{ $order === 'asc' ? '▲' : '▼' }}
                   @else
                       ▲
                   @endif

               </a>
           </th>
           <th scope="col" class="text-lg  p-2">
               <a href="{{ route('contacts.index', ['sort' => 'name', 'order' => $sort === 'name' && $order === 'asc' ? 'desc' : 'asc']) }}">
                   {{__('contact.email')}}
                   @if ($sort === 'name')
                       {{ $order === 'asc' ? '▲' : '▼' }}
                   @else
                       ▲
                   @endif

               </a>
           </th>
           <th scope="col" class="text-lg  p-2 rounded-tr-2xl">
               {{__('contact.avatar')}}
           </th>
       </tr>
       </thead>

       <tbody>
       @foreach($contacts as $contact)
       <tr class="border-t-1">
           <td class=" p-2">
               <a href="{!! route('contacts.show', $contact->id) !!}" class="text-blue-600 underline">
                   {!! $contact->name !!}
               </a>
           </td>
           <td class="p-2">
               <a title="Envoyer un mail à {!! $contact->email !!}" class="text-blue-600 underline"
                  href="mailto:{!! $contact->email !!}">
                   {!!$contact->email !!}
               </a>
           </td>
           <td class=" p-2">
               @if($contact->avatar)
                   <img
                       src="{{ asset('/images/contacts/variants/100x100/'.$contact->avatar) }}"
                       alt="Avatar de {!! $contact->name !!}" class="max-w-xs rounded-2xl">
               @else
                  {{__('contact.no_image_chosen')}}
               @endif

               {{--{!! $contact->avatar !!}--}}
           </td>
       </tr>
       </tbody>
       @endforeach
   </table>

        {{ $contacts->links() }}

@else
    <h1><em>{{__('contact.no_contact')}}</em></h1>
@endif
</div>
<br>
<div class="endsection block text-center pt-15">
<a href="{{ route('contacts.create') }}" class="text-white font-bold px-10 py-5 shadow-xl bg-cyan-700  rounded-2xl">
    {{__('contact.create_a_contact')}}
</a>
    </div>

@endcomponent
