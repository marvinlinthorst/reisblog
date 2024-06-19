<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet"/>

    @vite('resources/css/app.css')
</head>
<body class="font-sans antialiased dark:bg-black dark:text-white/50">
<header class="bg-blend-darken bg-no-repeat bg-cover h-96 bg-amber-300 bg-center" style="background-image: url(https://flowbite.s3.amazonaws.com/blocks/marketing-ui/articles/background.png);">


    <div class="container mx-auto translate-x-1/2	">
        <h1 class="mb-4 text-3xl font-extrabold leading-tight text-gray-900 lg:mb-6 lg:text-4xl dark:text-white">{{ $trip['trip']['title'] }}</h1>
    </div>
</header>

<div class="container mx-auto">
    <div class="bg-gray-900 min-h-64 p-10 -mt-32 rounded">

        @foreach ($trip['entries'] as $entry)
            <h2 class="text-xl font-bold text-gray-900 dark:text-white">{{ \Carbon\Carbon::createFromTimestampMs($entry['create'])->isoFormat('LLL') }}</h2>
            @if (! empty($entry['comment']))
                <p>{{ $entry['comment'] }}</p>
            @endif

            <div class="grid grid-cols-6 gap-4">

                @foreach ($entry['pictures'] as $picture)
                    <a href="{{ url('/storage/trips/' . $slug . '/' . $picture['guid'] . '_original.jpg') }}">
                        <img src="{{ url('/storage/trips/' . $slug . '/' . $picture['guid'] . '_ret.jpg') }}" class="w-32">
                    </a>
                @endforeach
            </div>
        @endforeach
    </div>

</div>

</body>
</html>
