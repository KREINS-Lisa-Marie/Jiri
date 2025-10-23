<div class="text_field pb-5 flex flex-col">
    <label for="{!! $name !!}" class="font-bold pb-2" >
        {!! $slot !!}
    </label>
    <input type="text" name="{{$name}}" id="{{$id}}" value="{{$value}}" class="bg-white rounded-xl p-2">
    @error($name)
    {{$message}}
    @enderror
</div>
