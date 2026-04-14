<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="le-edge">
    <title>Document</title>
    @vite(['resources/css/app.css'])

</head>

<body class="bg-background text-foreground">
    <x-layout.nav />

    <main class="max-w-7xl mx-auto px-6">
        {{ $slot }}
    </main>

    {{-- <div x-data="{ show: true }" x-inti="setTimeout() => show = false, 3000" x-show="show"
        x-transition.opacity.duration.300ms class="bg-primary px-4 absolute bottom-4 rounded-lg">Testing For Now
    </div> --}}
</body>

</html>
