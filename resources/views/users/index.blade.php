@component('layouts.app')
    <body>
    <section class="flex flex-col items-center ">
        <h2 class="font-bold text-4xl pb-20 mt-10">
            Mes données
        </h2>

       <dl class="mb-20 rounded-2xl p-6 shadow-2xl">
           <dt class="text-lg font-bold p-2 ">
               Nom
           </dt>
           <dd>
               {!! $user->name !!}
           </dd>
           <dt class="text-lg font-bold p-2">
               Email
           </dt>
           <dd>
               {!! $user->email !!}
           </dd>
           <dt class="text-lg font-bold p-2">
               Mot de passe
           </dt>
         <dd>
             <a href="{{route('users.edit', $user->id)}}" class="text-blue-600 underline">
                 Changer mon mot de passe
             </a>
         </dd>
       </dl>
        <a href="{{route('users.edit', $user->id)}}" class="text-white font-bold px-10 py-5 shadow-xl bg-cyan-700  rounded-2xl hover:bg-cyan-600 focus:outline-none focus:ring-2 focus:bg-cyan-600 focus:ring-offset-2 ">
            Modifier mes données
        </a>

        <form action="{{route('users.destroy', $user->id)}}" method="post">
            @method('DELETE')
            @csrf
            <button type="submit" class="text-white font-bold px-10 py-5 shadow-xl bg-red-700 mt-10  rounded-2xl hover:bg-red-800 focus:outline-none focus:ring-2 focus:bg-red-800 focus:ring-offset-2 ">Supprimer mon compte</button>
        </form>

    </section>
    </body>
@endcomponent
