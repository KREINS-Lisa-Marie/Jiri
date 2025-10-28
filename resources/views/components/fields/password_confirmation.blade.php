<div class="flex flex-col">
    <label for="password_confirmation" class="font-bold pb-2">
        {!! $slot !!}
    </label>
    @error('verification_password')
    <p class="error text-red-500">
        {{$message}}
    </p>
    @enderror
    <input type="password" id="password_confirmation" name="password_confirmation" class="bg-white rounded-xl p-2 focus:ring-2 focus:ring-blue-300 focus:border-b-blue-300" value="">
</div>
