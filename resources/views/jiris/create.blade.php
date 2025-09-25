<!doctype html>
<html lang="{!! app()->getLocale(); !!}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Lisa-Marie">
    <meta name="keywords" content="jiris">
    <title>Création d'un Jiri</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="p-6">
<h1 class="font-bold text-center">
    {!! __('headings.create_a_jiri') !!}
</h1>
<form action="{!! route('jiris.store') !!}" method="post">
    @csrf
    <div class="flex flex-col relative">
        <label for="name">
            Name <small>(Requis)</small>
        </label>
        @error('name')
        <p>
            {!! $message !!}
        </p>
        @enderror
        <input type="text" id="name" name="name" value="{{ old(__('validation.name')) }}">
    </div>
    <div class="flex flex-col relative">
        <label for="date">
            Date <small>(Requis)</small>
        </label>
        @error('date')
        <p>
            {!! $message !!}
        </p>
        @enderror
        <input type="text" id="date" name="date" value="{{ old('date') }}" class="border">
    </div>
    <div class="flex flex-col relative">
        <label for="description">
            __('validation.description')
        </label>
        @error('description')
        <p>
            {!! $message !!}
        </p>
        @enderror
        <input type="text" id="description" name="description" value="{{ old('description') }}">
    </div>
    <button type="submit" class="flex flex-col relative">
        __('labels-buttons.create_a_jiri')
    </button>
</form>
</body>
</html>
