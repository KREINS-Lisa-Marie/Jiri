{{--
@foreach($contacts as $contact)
    <div class="single_contact pb-4 flex gap-3">
        <div class="label_checkbox pb-4 flex flex-row-reverse justify-end"><label for="contacts{!! $contact->id !!}">{!! $contact->name !!}</label>
            <input type="checkbox" name="contacts[{!! $contact->id !!}]" class="mr-4"
                   id="contact{!! $contact->id !!}"
                   value="{!! $contact->id !!}"
                   @if( $attendance= \App\Models\Attendance::where('jiri_id', "===", $jiri->id)->where('contact_id',"===", $contact->id)->first())
                       checked
                @endif></div>
        <select class="bg-cyan-600 text-white p-2 rounded-2xl" name="contacts[{!! $contact->id !!}][role]" id="role{!! $contact->id !!}">
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
--}}
