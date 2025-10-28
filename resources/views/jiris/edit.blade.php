@component('layouts.app')
    <body>
    <main class="px-6 py-6 flex items-center flex-col">
        @if ($jiri)
            <h1 class="font-bold text-4xl pb-20">
                {{__('jiri.modify_the_jiri')}} : {{$jiri->name}}</h1>

            <form action='{{route('jiris.update', $jiri->id)}}' method="post"
                  class="bg-blue-50 rounded-2xl shadow-2xl p-10 min-w-2xl">
                @method('PATCH')
                @csrf
                <fieldset class="jiri_section pb-10">
                    {{--                <legend class="text-3xl font-medium pl-2 pb-3">
                                        {{__('labels-buttons.legend_jiri')}}
                                    </legend>--}}
                    @component('components.form.legend')
                        {{__('labels-buttons.legend_jiri')}}
                    @endcomponent
                    <div class="jiri_definition_fields">
                        {{--      <div class="text_field pb-5 flex flex-col">
                                  <label for="name" class="font-bold pb-2" >{{__('labels-buttons.name')}}</label>
                                  <input type="text" name="name" id="name" value="{{$jiri->name}}" class="bg-white rounded-xl p-2">
                                  @error('name')
                                  {{$message}}
                                  @enderror
                              </div>--}}
                        @component('components.fields.text', ['name' => 'name',
                            'value' => $jiri->name,
                            'id' => 'name',
                            ])
                            {{__('labels-buttons.name')}}
                        @endcomponent
                        {{--      <div class="text_field pb-5 flex flex-col">
                                  <label for="date" class="font-bold pb-2" >{{__('labels-buttons.date')}}</label>
                                  <input type="date" name="date" id="date" value="{{$jiri->date}}" class="bg-white rounded-xl p-2">
                                  @error('date')
                                  {{$message}}
                                  @enderror
                              </div>--}}
                        @component('components.fields.date', ['old_date' =>  $jiri->date])
                            {{__('labels-buttons.date')}}
                        @endcomponent
                        {{--                    <div class="textarea_field pb-5 flex flex-col">
                                                <label for="description" class="font-bold pb-2" >
                                                    {{__('labels-buttons.description')}}
                                                </label>
                                                <textarea name="description" id="description"
                                                          placeholder="Le Jury ... évalue..." class="bg-white rounded-xl p-2">{{$jiri->description ?? ""}}</textarea>
                                                @error('description')
                                                {{$message}}
                                                @enderror
                                            </div>--}}
                        @component('components.fields.textarea', ['old_values' =>  $jiri->description ?? ""])
                            {{__('labels-buttons.description')}}
                        @endcomponent
                    </div>
                </fieldset>
                <fieldset class="contact_section">
                    {{--  <legend class="text-3xl font-medium pl-2 pb-3">
                          {{__('labels-buttons.legend_contacts')}}
                      </legend>--}}
                    @component('components.form.legend')
                        {{__('labels-buttons.legend_contacts')}}
                    @endcomponent
                    <div class="contacts_definition_fields">
                        {{--            @foreach($contacts as $contact)
                                        <label for="contact_name">{!! $contact->name !!}</label>
                                        <input type="checkbox" id="contact_name" name="$contacts[]">
                                    @endforeach--}}
                        @foreach($contacts as $contact)
                            <div class="single_contact pb-4 flex gap-3">
                                <div class="label_checkbox pb-4 flex flex-row-reverse justify-end"><label
                                        for="contacts{!! $contact->id !!}">{!! $contact->name !!}</label>
                                    <input type="checkbox" name="contacts[{!! $contact->id !!}]" class="mr-4"
                                           id="contact{!! $contact->id !!}"
                                           value="{!! $contact->id !!}"
                                           @if( $attendance= \App\Models\Attendance::where('jiri_id', "===", $jiri->id)->where('contact_id',"===", $contact->id)->first())
                                               checked
                                        @endif></div>
                                <select class="bg-cyan-600 text-white p-2 rounded-2xl"
                                        name="contacts[{!! $contact->id !!}][role]" id="role{!! $contact->id !!}">
                                    @foreach(\App\Enums\ContactRoles::cases() as $role)
                                        <option value="{{$role->value}}"
                                                @if($attendance && $attendance->role === $role->value)
                                                    selected
                                            @endif>
                                            {{$role->value}}</option>
                                    @endforeach
                                </select>
                            </div>
                        @endforeach
                        {{--<div class="single_contact">
                            <label for="contact_name">Anika</label>
                            <input type="checkbox" id="contact_name" name="contacts[1]" {{old('checked' ?? "")}}>
                            <select name="contacts[1][role]">
                                @foreach(\App\Enums\ContactRoles::cases() as $role)
                                    <option value="{{$role->value}}">{{$role->value}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="single_contact">
                            <label for="contact_name">Lucas</label>
                            <input type="checkbox" id="contact_name" name="contacts[2]" {{old('checked' ?? "")}}>
                            <select name="contacts[2][role]">
                                @foreach(\App\Enums\ContactRoles::cases() as $role)
                                    <option value="{{$role->value}}">{{$role->value}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="single_contact">
                            <label for="contact_name">Elisa</label>
                            <input type="checkbox" id="contact_name" name="contacts[3]" {{old('checked' ?? "")}}>
                            <select name="contacts[3][role]">
                                @foreach(\App\Enums\ContactRoles::cases() as $role)
                                    <option value="{{$role->value}}">{{$role->value}}</option>
                                @endforeach
                            </select>
                        </div>--}}
                    </div>
                </fieldset>
                <fieldset class="project_section">
                    {{--          <legend class="text-3xl font-medium pl-2 pb-3">
                                  {{__('labels-buttons.legend_projects')}}
                              </legend>--}}
                    @component('components.form.legend')
                        {{__('labels-buttons.legend_projects')}}
                    @endcomponent
                    <div class="projects_definition_fields">
                        @foreach($projects as $project)
                            <div class="single_project pb-4 flex flex-row-reverse justify-end">
                                <label for="projects[{!! $project->id !!}]">{!! $project->name !!}</label>
                                <input type="checkbox" id="projects{!! $project->id !!}"
                                       name="projects[{!! $project->id !!}]" value="{!! $project->id !!}"
                                       @if($homework = \App\Models\Homework::where('jiri_id', "===", $jiri->id)->where('project_id',"===", $project->id)->first())
                                           checked
                                       @endif class="mr-4">

                            </div>
                        @endforeach
                        {{-- <div class="single_project">
                             <label for="project_name">CV</label>
                             <input type="checkbox" id="project_name" name="projects[1]" value="1" {{old('checked' ?? "")}}>
                         </div>
                         <div class="single_project">
                             <label for="project_name">Portfolio</label>
                             <input type="checkbox" id="project_name" name="projects[2]" value="2" {{old('checked' ?? "")}}>
                         </div>
                         <div class="single_project">
                             <label for="project_name">Client</label>
                             <input type="checkbox" id="project_name" name="projects[3]" value="3" {{old('checked' ?? "")}}>
                         </div>--}}
                    </div>
                </fieldset>
                {{--     <button type="submit" class="text-white font-bold px-10 py-5 shadow-xl bg-cyan-700  rounded-2xl">
                         {{__('labels-buttons.modify_a_jiri')}}
                     </button>--}}
                @component('components.button')
                    {{__('labels-buttons.modify_a_jiri')}}
                @endcomponent
            </form>

        @else
            <h1><em>
                    {{__('jiri.no_jiris_available_to_modify')}}
                </em></h1>
        @endif
    </main>
    </body>
@endcomponent
