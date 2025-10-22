@component('layouts.app')
<body class="">
<section class="project_section px-6 py-6 flex items-center flex-col ">
    @if ($projects->isNotEmpty())
        <h1 class="font-bold text-4xl pb-20">Liste des projets</h1>
        <table class=" px-4 mt-4 shadow-xl rounded-2xl">
            <thead class="bg-cyan-700 text-white">
            <tr class="">
                <th scope="col" class="text-lg px-0  p-2">
                    Nom du projet
                </th>
            </tr>
            </thead>
            <tbody>
            @foreach($projects as $project)
                <tr class="text-center border-t-1" >
                    <td class="p-2">
                        <a href="{!! route('projects.show', $project->id) !!}" class="underline text-blue-600">
                            {!! $project->name !!}
                        </a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @else
        <h1><em>Il n’y a pas de projets </em></h1>
        <h1><em>Il n’y a pas de projets </em></h1>
    @endif
    <br>
</section>
<div class="endsection block text-center mt-10">
    <a href="{!! route('projects.create')!!}" class="text-white font-bold px-10 py-5 shadow-xl bg-cyan-700  rounded-2xl">
        Créer un nouveau Projet
    </a></div>

</body>
@endcomponent
