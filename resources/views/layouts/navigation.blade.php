<aside class="fixed">
    <nav class="w-64 bg-cyan-700 p-8 text-white font-bold flex  mb-10 text-xl  h-screen flex-col text-center justify-between">
        <div class="min-w-full border-b-2">
            <h2 class="bb-2 py-6">
                Bonjour {{Auth::user()->name}}
            </h2></div>
        <div class="flex flex-col">
            <a href="{{route('jiris.index')}}" class="py-6">Mes Jiris</a>
            <a href="{{route('projects.index')}}" class="py-6">Mes Projects</a>
            <a href="{{route('contacts.index')}}" class="py-6">Mes contacts</a></div>
        <div class="min-w-full  border-t-2 py-6">

            <form action="{{route('logout')}}" method="POST">
                @csrf
                <button type="submit">Déconnexion</button>
            </form>
        </div>
    </nav>
</aside>
