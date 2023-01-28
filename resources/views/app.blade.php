<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" href="/icon.png" sizes="32x32">
        <title inertia>{{ config('app.name', 'Laravel') }}</title>

        @vite('resources/sass/app.scss')
        @routes((auth()->check()&&auth()->user()->isPermission('admin'))?'admin':(auth()->check()?'user':'guest'))
        @vite(['resources/js/app.js', "resources/js/Pages/{$page['component']}.vue"])
        @inertiaHead
    </head>
    <body>
        @inertia
    </body>

</html>
