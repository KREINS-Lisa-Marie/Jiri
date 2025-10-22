@component('layouts.app')
<body>
<main class="project_section px-6 py-6 flex items-center flex-col ">
    @if ($project)

        <h1 class="font-bold text-4xl pb-20">Détail du Projet : {{$project->name}}</h1>
        <div class="bg-blue-50 rounded-2xl shadow-2xl p-10 max-w-2xl mb-20">
            <h2 class="text-lg px-0 font-bold p-2">Nom du projet :</h2>
            <p>{!!$project->name;!!}</p>
        </div>
        <br>
        <a href="{{ route('projects.edit', $project->id) }}" class="text-white font-bold px-10 py-5 shadow-xl bg-cyan-700  rounded-2xl">
            Modifier le projet
        </a>

    @else
        <h1><em>Il n’y a pas de projets </em></h1>
    @endif

</main>

</body>
@endcomponent
