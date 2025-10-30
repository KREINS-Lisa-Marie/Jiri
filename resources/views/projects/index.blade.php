@component('layouts.app')
<body class="">
<section class="project_section px-6 py-6 flex items-center flex-col ">
    @if ($projects->isNotEmpty())
        <h1 class="font-bold text-4xl pb-20">
            {{__('project.project_list')}}
        </h1>


        <div class="statistics flex flex-row gap-10 mb-20">
            <section class="py-24 bg-white rounded-2xl shadow-2xl min-w-80 max-w-80 text-center">
                <h2 class="font-bold text-xl ">
                    {{__('project.total_projects')}}
                </h2>
                <p>
                    {!! $projectnumber->count() !!}
                </p>
            </section>
        </div>

        <table class=" px-4 mt-4 shadow-xl rounded-2xl">
            <thead class="bg-cyan-700 text-white">
            <tr class="">
                <th scope="col" class="text-lg p-4 rounded-t-2xl">
                    <a href="{{ route('projects.index', ['sort' => 'name', 'order' => $sort === 'name' && $order === 'asc' ? 'desc' : 'asc']) }}">
                        {{__('project.projectname')}}
                        @if ($sort === 'name')
                            {{ $order === 'asc' ? '▲' : '▼' }}
                        @else
                            ▲
                        @endif

                    </a>
                </th>
            </tr>
            </thead>
            <tbody>
            @foreach($projects as $project)
                <tr class="text-center border-t-1" >
                    <td class="p-4" >
                        <a href="{!! route('projects.show', $project->id) !!}" class="underline text-blue-600">
                            {!! $project->name !!}
                        </a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @else
        <h1><em>
                {{__('project.no_projects_available')}}
            </em></h1>
    @endif
    <br>
        {{ $projects->links() }}
</section>

<div class="endsection block text-center mt-10">
    <a href="{!! route('projects.create')!!}" class="text-white font-bold px-10 py-5 shadow-xl bg-cyan-700  rounded-2xl">
        {{__('project.create_a_new_project')}}
    </a></div>

</body>
@endcomponent
