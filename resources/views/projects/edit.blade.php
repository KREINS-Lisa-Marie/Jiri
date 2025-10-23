@component('layouts.app')
<body>
<main class="px-6 py-6 flex items-center flex-col">
    <h1 class="font-bold text-4xl pb-20"
    >{{__('headings.edit_a_project')}}</h1>

    <form action="{!! route('projects.update', $project->id) !!}" method="post" class="bg-blue-50 rounded-2xl shadow-2xl p-10 min-w-2xl"
          enctype="multipart/form-data">
        @method('PATCH')
        @csrf
        <div class="field">
            <div class="text_field pb-5 flex flex-col">
                <label for="name" class="font-bold pb-2" >{{__('labels-buttons.name')}}</label>
                <input type="text" id="name" name="name"
                       class="bg-white rounded-xl p-2"
                       value="{{$project->name}}">
                @error('name')
                <p class="error text-red-500">
                    {{$message}}
                </p>
                @enderror
            </div>
        </div>
        <div class="flex justify-center">

            @component('components.button')
            {{--       <button type="submit"
                    class="text-white font-bold px-10 py-5 shadow-xl bg-cyan-700  rounded-2xl hover:bg-cyan-600 focus:outline-none focus:ring-2 focus:bg-cyan-600 focus:ring-offset-2 ">
                {{__('labels-buttons.modify_a_project')}}
            </button>--}}
            {{__('labels-buttons.modify_a_project')}}
            @endcomponent
        </div>
    </form>

</main>
</body>
@endcomponent
