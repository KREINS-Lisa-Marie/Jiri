@component('layouts.app')
<body>
<main class="px-6 py-6 flex items-center flex-col ">
    <h1 class="font-bold text-4xl pb-20"
    >{{__('headings.create_a_contact')}}
    </h1>

    <form action="{!! route('contacts.store') !!}" method="post" enctype="multipart/form-data" class="bg-blue-50 rounded-2xl shadow-2xl p-10 min-w-2xl">
        @csrf
        <div class="field ">
            @component('components.fields.text', ['name' => 'name', 'id'=>'name', 'value' =>old('name') ])
         {{--   <div class="text_field pb-5 flex flex-col">
                <label for="name" class="font-bold pb-2">{{__('labels-buttons.name')}}</label>
                <input type="text" id="name" name="name"
                       class="bg-white rounded-xl p-2 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
                       value="{{old('name')}}">
                @error('name')
                <p class="error text-red-500">
                    {{$message}}
                </p>
                @enderror
            </div>--}}
                {{__('labels-buttons.name')}}
            @endcomponent
           {{-- <div class="email text_field pb-5 flex flex-col">
                <label for="email"  class="font-bold pb-2" >{{__('labels-buttons.email')}}</label>
                <input type="email" id="email" name="email"
                       class="bg-white rounded-xl p-2 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
                       value="{{old('email')}}">
                @error('email')
                <p class="error text-red-500">
                    {{$message}}
                </p>
                @enderror
            </div>--}}
                @component('components.fields.email', ['value' => old('email')])
                    {{__('labels-buttons.email')}}
                @endcomponent
                @component('components.fields.file', ['name_id' => 'avatar'])
                    {{__('labels-buttons.avatar')}}
                @endcomponent
            {{--<div class="avatar ftext_field pb-5 flex flex-col">
                <label for="avatar"  class="font-bold pb-2" >{{__('labels-buttons.avatar')}}</label>
                <input type="hidden" name="MAX_FILE_SIZE" value="3000000000"/>
                <input type="file" id="avatar" name="avatar"
                       class="bg-white rounded-xl p-2 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                @error('avatar')
                <p class="error text-red-500">
                    {{$message}}
                </p>
                @enderror
            </div>--}}
        </div>
        <div class="flex justify-center mt-10">
           {{-- <button type="submit"
                    class="text-white font-bold px-10 py-5 shadow-xl bg-cyan-700  rounded-2xl hover:bg-cyan-600 focus:outline-none focus:ring-2 focus:bg-cyan-600 focus:ring-offset-2 ">
                {{__('labels-buttons.create_a_contact')}}
            </button>--}}
            @component('components.button')
                {{__('labels-buttons.modify_a_contact')}}
            @endcomponent
        </div>
    </form>
</main>
</body>
@endcomponent
