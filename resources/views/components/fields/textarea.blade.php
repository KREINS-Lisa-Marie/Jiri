<div class="textarea_field pb-5 flex flex-col">
    <label for="description" class="font-bold pb-2" >
        {!! $slot !!}
    </label>
    <textarea id="description" name="description"
              placeholder="Le Jury ... évalue..." class="bg-white rounded-xl p-2">{!! $old_values !!}</textarea>
</div>
