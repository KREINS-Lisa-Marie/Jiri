<div class="text_field pb-5 flex flex-col">
    <label for="date" class="font-bold pb-2" >
        {!! $slot !!}
    </label>
    <input type="date" name="date" id="date" value="{!! $old_date !!}" class="bg-white rounded-xl p-2">
    @error('date')
    {{$message}}
    @enderror
</div>
