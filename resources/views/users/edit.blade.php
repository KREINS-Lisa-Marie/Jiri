@component('layouts.app')
    <body>
    <section class="flex flex-col items-center ">
        <h2 class="font-bold text-4xl pb-20 mt-10">
            {{__('user.modify_my_data')}}
        </h2>

        <form action="{!! route('users.update', $user->id) !!}" method="post" class="bg-blue-50 rounded-2xl shadow-2xl p-10 min-w-2xl"
              enctype="multipart/form-data">
            @method('PATCH')
            @csrf
            <div class="field">
                @component('components.fields.text', ['name' => 'name', 'id'=>'name', 'value' => $user->name])
                    {{__('labels-buttons.name')}}
                @endcomponent
                    {{--                <div class="text_field pb-5 flex flex-col">
                    <label for="name" class="font-bold pb-2" >{{__('labels-buttons.name')}}</label>
                    <input type="text" id="name" name="name"
                           class="bg-white rounded-xl p-2"
                           value="{{$user->name}}">
                    @error('name')
                    <p class="error text-red-500">
                        {{$message}}
                    </p>
                    @enderror
                </div>--}}
                    @component('components.fields.email', ['value' => $user->email])
                        {{__('labels-buttons.email')}}
                    @endcomponent
                    {{--                <div class="text_field pb-5 flex flex-col">
                    <label for="email" class="font-bold pb-2" >{{__('labels-buttons.email')}}</label>
                    <input type="text" id="email" name="email"
                           class="bg-white rounded-xl p-2"
                           value="{{$user->email}}">
                    @error('email')
                    <p class="error text-red-500">
                        {{$message}}
                    </p>
                    @enderror
                </div>--}}

            </div>
            <div class="field">
            @component('components.fields.password')
                {{__('user.new_password')}}
            @endcomponent
            {{--<div class="flex flex-col">
                <label for="password" class="font-bold pb-2">
                    {{__('user.new_password')}}
                </label>
                @error('password')
                <p class="error text-red-500">
                    {{$message}}
                </p>
                @enderror
                <input type="password" id="password" name="password" class="bg-white rounded-xl p-2 focus:ring-2 focus:ring-blue-300 focus:border-b-blue-300" value="">
            </div>--}}
            {{--
            <div class="flex flex-col">
                <label for="password_confirmation" class="font-bold pb-2">
                    {{__('user.confirmation_password')}}
                </label>
                @error('verification_password')
                <p class="error text-red-500">
                    {{$message}}
                </p>
                @enderror
                <input type="password" id="password_confirmation" name="password_confirmation" class="bg-white rounded-xl p-2 focus:ring-2 focus:ring-blue-300 focus:border-b-blue-300" value="">
            </div>
--}}
            @component('components.fields.password_confirmation')
                {{__('user.confirmation_password')}}
            @endcomponent
                </div>
            <div class="flex justify-center mt-10">
                @component('components.button')
                    {{--       <button type="submit"
                            class="text-white font-bold px-10 py-5 shadow-xl bg-cyan-700  rounded-2xl hover:bg-cyan-600 focus:outline-none focus:ring-2 focus:bg-cyan-600 focus:ring-offset-2 ">
                        {{__('labels-buttons.modify_a_project')}}
                    </button>--}}
                    {{__('labels-buttons.modify_a_user')}}
                @endcomponent
            </div>
        </form>
    </section>
    </body>
@endcomponent
