@php
    $currentSort = request('sort');
    $currentOrder = request('order', 'asc');
@endphp

@component('layouts.app')
<body>
    <section class="px-6 py-6 flex items-center flex-col">
        @if($jiri)
            <div class="heading flex items-center flex-col">
                <h1 class="font-bold text-4xl pb-20 ">
                    Détail du Jiri : {!! $jiri->name !!}
                </h1>
                <a href="{{ route('jiris.edit', $jiri->id) }}"
                   class="text-white font-bold px-10 py-5 shadow-xl bg-cyan-700  rounded-2xl ">
                    Modifier le jiri
                </a>
            </div>
            <section class="jiri_details mt-12">
                <h2 class="font-bold text-3xl text-center py-6">
                    {!! $jiri->name !!}
                </h2>
                <div class="flex flex-row flex-wrap gap-5">
                    <div>
                        <h3 class="font-bold text-md p-3">Nom</h3>
                        <p class="text-center">{!! $jiri->name !!}</p>
                    </div>
                    <div>
                        <h3 class="font-bold text-md p-3">Date</h3>
                        <p class="text-center">
                            {!! $jiri->date !!}
                        </p>
                    </div>
                    <div>
                        <h3 class="font-bold text-md p-3">Description</h3>
                        <p>
                            {!! $jiri->description !!}
                        </p>
                    </div>
                    <div>
                        <h3 class="font-bold text-md p-3">
                            Nombre Projets
                        </h3>
                        <p class="text-center">
                            {!! $jiri->projects->count() !!}
                        </p>
                    </div>
                    <div>
                        <h3 class="font-bold text-md p-3">
                            Nombre Evaluateurs
                        </h3>
                        <p class="text-center">
                            {!! $jiri->evaluators->count() !!}
                        </p>
                    </div>
                    <div>
                        <h3 class="font-bold text-md p-3">
                            Nombre Evalués
                        </h3>
                        <p class="text-center">
                            {!! $jiri->evaluated->count() !!}
                        </p>
                    </div>
                </div>
            </section>
            <div class="flex flex-row gap-10 mt-20">
                <section class="projects_section">
                    <h2 class="font-bold text-2xl px-4 py-6">Projets concernant le jiri</h2>
                    <table class="rounded-2xl max-w-200 shadow-2xl">
                        <thead class="bg-cyan-700 text-white">
                        <tr class="">
                            <th scope="col" class="p-5">
                                Nom du projet
                                <a href="{{ route('jiris.show', ['jiri' => $jiri->id, 'sort' => 'email', 'order' => request('order') === 'asc' && request('sort') === 'email' ? 'desc' : 'asc']) }}">
                                    @if ($currentSort === 'email')
                                        {{ $currentOrder === 'asc' ? '▲' : '▼' }}
                                    @else
                                        ▲
                                    @endif
                                </a>
                            </th>
                            <th scope="col" class=" p-5">
                                Implémentations
                            </th>
                        </tr>
                        </thead>
                        <tbody class="">
                        @foreach($jiri->projects as $project)
                            <tr class="">
                                <td class=" p-5">
                                    {!! $project->name !!}
                                </td>
                                <td class="p-5">
                                    {!! $jiri->evaluated()->count() !!}
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </section>
                <section class="contacts_section">
                    <h2 class="font-bold text-2xl px-4 py-6">
                        Contacts du jiri
                    </h2>
                    <table class="p-5 rounded-2xl max-w-200 shadow-2xl">
                        <thead class="bg-cyan-700 text-white">
                        <tr class="">
                            <th scope="col" class="p-5 ">
                                Nom
                                <a href="{{ route("jiris.show", ['jiri' => $jiri->id,'sort' => 'name', 'order' => request('order') === 'asc' && request('sort') === 'name' ? 'desc' : 'asc']) }}">
                                    @if ($currentSort === 'name')
                                        {{ $currentOrder === 'asc' ? '▲' : '▼' }}
                                    @else
                                        ▲
                                    @endif
                                </a>

                            </th>
                            <th scope="col" class="p-5">
                                Adresse e-mail
                                <a href="{{ route('jiris.show', ['jiri' => $jiri->id, 'sort' => 'email', 'order' => request('order') === 'asc' && request('sort') === 'email' ? 'desc' : 'asc']) }}">
                                    @if ($currentSort === 'email')
                                        {{ $currentOrder === 'asc' ? '▲' : '▼' }}
                                    @else
                                        ▲
                                    @endif
                                </a>
                            </th>
                            <th scope="col" class="p-5">
                                Rôle
                            </th>
                        </tr>
                        </thead>
                        <tbody class="">
                        @foreach($jiri->contacts as $contact)
                            <tr class="">
                                <td class=" p-5">
                                    {!! $contact->name !!}
                                </td>
                                <td class="p-5">
                                    {!! $contact->email !!}
                                </td>
                                <td class=" p-5">
                                    {!! __('labels-buttons.'.$jiri->attendances()->where('contact_id', $contact->id)->pluck('role')->first()) !!}
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </section>
            </div>
        @else
            <h1><em>Il n’y a pas de Jiris </em></h1>
        @endif
    </section>
</body>
@endcomponent
