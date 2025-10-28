<div class="avatar ftext_field pb-5 flex flex-col">
    <label for="{{$name_id}}"  class="font-bold pb-2" >
        {!! $slot !!}
    </label>
    <input type="hidden" name="MAX_FILE_SIZE" value="3000000000"/>
    <input type="file" id="{{$name_id}}" name="{{$name_id}}"
           class="bg-white rounded-xl p-2 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
    @error("{{$name_id}}")
    <p class="error text-red-500">
        {{$message}}
    </p>
    @enderror
</div>
