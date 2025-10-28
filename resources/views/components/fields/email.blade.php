<div class="email text_field pb-5 flex flex-col">
    <label for="email"  class="font-bold pb-2" >
        {!! $slot!!}
    </label>
    <input type="email" id="email" name="email"
           class="bg-white rounded-xl p-2 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
           value="{{$value}}">
    @error('email')
    <p class="error text-red-500">
        {{$message}}
    </p>
    @enderror
</div>
