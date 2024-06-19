<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet"/>

    @vite('resources/css/app.css')
    @vite('resources/js/app.js')
</head>
<body class="font-sans antialiased dark:bg-black dark:text-white">
<header class="bg-no-repeat bg-cover h-96 bg-center flex relative" style="background-image: url('{{ url('/storage/trips/' . $slug . '/' . $trip['trip']['pictureGuid']. '_original.jpg')  }}');">
    <div class="h-full w-full bg-black absolute z-10 opacity-30"></div>

    <div class="container mx-auto flex justify-center items-center pb-32 relative z-10">
        <h1 class="mb-4 text-3xl font-extrabold leading-tight text-gray-900 lg:mb-6 lg:text-4xl dark:text-white">{{ $trip['trip']['title'] }}</h1>
    </div>
</header>

<div class="container mx-auto relative z-20">
    <div class="bg-gray-900 min-h-64 p-10 -mt-32 rounded">
        <div class="grid grid-cols-12">
            <div class="col-span-8">
                @foreach ($entries as $entry)
                    <div class="mb-5">
                        <h2 class="text-xl font-bold text-gray-900 dark:text-white">{{ \Carbon\Carbon::createFromTimestampMs($entry['create'])->locale('nl-NL')->isoFormat('LLL') }}</h2>
                        @if (! empty($entry['comment']))
                            <p>{{ $entry['comment'] }}</p>
                        @endif

                        <div class="grid grid-cols-6 gap-4 mt-3 gallery">

                            @foreach ($entry['pictures'] as $picture)
                                <a href="{{ url('/storage/trips/' . $slug . '/' . $picture['guid'] . '_original.jpg') }}"

                                   data-pswp-width="{{ $picture['width'] }}"
                                   data-pswp-height="{{ $picture['height'] }}"
                                >
                                    <img src="{{ url('/storage/trips/' . $slug . '/' . $picture['guid'] . '_ret.jpg') }}" class="w-32">
                                </a>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="col-span-4">
                kaartie
            </div>

        </div>
    </div>

</div>

</body>
</html>
