<div class="flex flex-col">
    <label for="password" class="font-bold pb-2">
        {!! $slot !!}
    </label>
    @error('password')
    <p class="error text-red-500">
        {{$message}}
    </p>
    @enderror
    <input type="password" id="password" name="password" class="bg-white rounded-xl p-2 focus:ring-2 focus:ring-blue-300 focus:border-b-blue-300" value="">
</div>
