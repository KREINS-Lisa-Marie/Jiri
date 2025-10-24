@component('layouts.app')
<body>
<section class="project_section px-6 py-6 flex items-center flex-col">
@if ($jiris->isNotEmpty() && $user)
    <div class="block text-center">
        <h1 class="font-bold text-4xl pb-20">Liste des Jiris de {{$user->name}}</h1>
        {{-- <ol>
             @foreach ($user->jiris as $jiri)

                 <li>
                     <a href="/jiris/{{ $jiri->id }}">
                         {!!$jiri->name;!!}
                     </a>
                 </li>

             @endforeach
         </ol>

     --}}

        <div class="flex justify-between">
            <a href="{{ route('jiris.create') }}"
                 class="text-white font-bold px-10 py-5 shadow-xl bg-cyan-700  rounded-2xl"
                 title="aller vers le site 'Créer un jiri'">Créer un Jiri</a>
            <a href="" class="text-white font-bold px-10 py-5 shadow-xl bg-cyan-700  rounded-2xl">
                Filtrer
            </a>
        </div>
    </div>
    <br>
    <br>
    <section class="flex flex-col p-10 items-center">
        <table class="rounded-2xl max-w-200 shadow-2xl">
            <thead class=" bg-cyan-700 text-white">
            <tr class="">
                <th scope="col" class=" p-4 rounded-tl-2xl ">
                    <div>

                        <a href="{{ route('jiris.index', ['sort' => 'name', 'order' => $sort === 'name' && $order === 'asc' ? 'desc' : 'asc']) }}">
                            Nom

                            @if ($sort === 'name')
                                {{ $order === 'asc' ? '▲' : '▼' }}
                            @else
                                ▲
                            @endif
                        </a>
                        {{--             <svg height="12" width="16" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="black">
                                         <polygon points="0,0 16,0 8,12" />
                                     </svg>--}}
                    </div>
                </th>
                <th scope="col" class=" p-4">
                    <div>
                        <a href="{{ route('jiris.index', ['sort' => 'name', 'order' => $sort === 'name' && $order === 'asc' ? 'desc' : 'asc']) }}">
                            Date
                            @if ($sort === 'name')
                                {{ $order === 'asc' ? '▲' : '▼' }}
                            @else
                                ▲
                            @endif
                        </a>
                    </div>
                </th>
                <th scope="col" class=" p-4">
                    <div>
                        Description
                    </div>
                </th>
                <th class=" p-4">
                    Projets
                </th>
                <th class="p-4">
                    Évalués
                </th>
                <th class=" p-4 rounded-tr-2xl">
                    Évaluateurs
                </th>
            </tr>
            </thead>
            <tbody>
            @foreach($jiris as $jiri)
                <tr class="border-t-1 ">
                    <td class=" p-2 ">
                        <a href="{!! route('jiris.show', $jiri->id) !!}" class="underline text-cyan-700 font-bold">
                            {!! $jiri->name !!}
                        </a>
                    </td>
                    <td class=" p-2">
                        {!! $jiri->date !!}
                    </td>
                    <td class=" p-2">
                        {!! $jiri->description !!}
                    </td>
                    <td class=" p-2">
                        {!! $jiri->projects->count() !!}
                    </td>
                    <td class=" p-2">
                        {!! $jiri->evaluated->count() !!}
                    </td>
                    <td class=" p-2">
                        {!! $jiri->evaluators->count() !!}
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </section>

@else
    <h1><em>Il n’y a pas de Jiris </em></h1>
@endif
</section>
{{ $jiris->links() }}
</body>
@endcomponent
