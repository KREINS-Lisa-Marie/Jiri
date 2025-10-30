@component('layouts.app')
<body class="bg-gray-100 pb-20">
<section class="project_section px-6 py-6 flex items-center flex-col">
@if ($jiris->isNotEmpty() && $user)
        <div class="block text-center">
        <h1 class="font-bold text-4xl pb-20">
            {{__('jiri.jiri_list_of')}}{{$user->name}}</h1>
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
        <div class="statistics flex flex-row gap-10 mb-20">
            <section class="py-24 bg-white rounded-2xl shadow-2xl min-w-80 max-w-80">
                <h2 class="font-bold text-xl">
                    {{__('jiri.total_jiris')}}
                </h2>
                <p>
                    {!! $jirinumber->count() !!}
                </p>
            </section>
            <section class="py-24 bg-white rounded-2xl shadow-2xl min-w-80 max-w-80">
                <h2 class="font-bold text-xl">
                    {{__('jiri.total_contacts')}}
                </h2>
                <p>
                    {!! $contacts->count() !!}
                </p>
            </section>
            <section class=" py-24 bg-white rounded-2xl shadow-2xl min-w-80 max-w-80">
                <h2 class="font-bold text-xl">
                    {{__('jiri.total_projects_to_evaluate')}}
                </h2>
                <p>
                    {!! $projects->count() !!}
                </p>
            </section>
        </div>
            <div class="my-20">
                <a href="{{ route('jiris.create') }}"
                   class="text-white font-bold px-10 py-5 shadow-xl bg-cyan-700  rounded-2xl"
                   title="aller vers le site 'Créer un jiri'">
                    {{__('jiri.create_a_jiri')}}
                </a>
            </div>
        <div class="flex justify-center items-center gap-10">

{{--            <a href="" class="text-white font-bold px-10 py-5 shadow-xl bg-cyan-700  rounded-2xl">
                {{__('jiri.filter')}}
            </a>
            <a href="">

            </a>--}}
            {{-- Filter Form --}}
   {{--         <form method="GET" action="{{ route('jiris.index') }}" class="mb-4">
                <div class="row g-2 align-items-center">
                    <div class="col-auto">
                        <label for="project_id" class="col-form-label">
                            Filter by Project:
                        </label>
                    </div>
                    <div class="col-auto">
                        <select name="project_id" id="project_id" class="form-select" onchange="this.form.submit()">
                            <option value="">
                                All Projects
                            </option>
                            @foreach ($projects as $project)
                                <option value="{{ $project->id }}" {{ request('project_id') == $project->id ? 'selected' : '' }}>
                                    {{ $project->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </form>--}}
            <form method="GET" action="{{ route('jiris.index') }}" class="mb-6 flex flex-col md:flex-row gap-4 items-center">
                <!-- Filtrer les projets -->
                <div>
                    <label for="project_id" class="font-semibold">Filter by Project:</label>
                    <select name="project_id" id="project_id" class="form-select" onchange="this.form.submit()">
                        <option value="">
                            All Projects
                        </option>
                        @foreach ($projects as $project)
                            <option value="{{ $project->id }}" {{ request('project_id') == $project->id ? 'selected' : '' }}>
                                {{ $project->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </form>


            <form method="GET" action="{{ route('jiris.index') }}" class="mb-6 flex flex-col md:flex-row gap-4 items-center">
                    <div class="text_field pb-5 flex flex-col">
                        <label for="date" class="font-bold pb-2" >
                            {{__('jiri.start_date')}}
                        </label>
                        <input type="date" name="start_date" id="date" value="{{request('start_date')}}" class="bg-white rounded-xl p-2">
                        @error('date')
                        {{$message}}
                        @enderror
                    </div>

                    <div class="text_field pb-5 flex flex-col">
                        <label for="date" class="font-bold pb-2" >
                            {{__('jiri.end_date')}}
                        </label>
                        <input type="date" name="end_date" id="date" value="{{request('end_date')}}" class="bg-white rounded-xl p-2">
                        @error('date')
                        {{$message}}
                        @enderror
                    </div>
                @component('components.button')
                        {{__('labels-buttons.filter')}}
                    @endcomponent
            </form>
        </div>
    </div>
    <section class="flex flex-col p-10 items-center">
        <table class="rounded-2xl max-w-200 shadow-2xl">
            <thead class=" bg-cyan-700 text-white">
            <tr class="">
                <th scope="col" class=" p-4 rounded-tl-2xl ">
                    <div>

                        <a href="{{ route('jiris.index', ['sort' => 'name', 'order' => $sort === 'name' && $order === 'asc' ? 'desc' : 'asc']) }}">
                            {{__('jiri.name')}}
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
                            {{__('jiri.date')}}
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
                        {{__('jiri.description')}}
                    </div>
                </th>
                <th class=" p-4">
                    {{__('jiri.projects')}}
                </th>
                <th class="p-4">
                    {{__('jiri.evaluated')}}
                </th>
                <th class=" p-4 rounded-tr-2xl">
                    {{__('jiri.evaluators')}}
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
    <h1><em>
        {{__('jiri.no_jiris_available')}}
        </em></h1>
@endif
</section>
{{ $jiris->links() }}
</body>
@endcomponent
