<!DOCTYPE html class="h-full bg-gray-100">
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        @vite('resources/css/app.css')
        <link rel="stylesheet" href="https://rsms.me/inter/inter.css" />
        <script
            defer
            src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"
        ></script>
        <title>Admin Portal Berita</title>
    </head>
    <body class="h-full">
        <!--
  This example requires updating your template:

  ```
  <html class="h-full bg-gray-100">
  <body class="h-full">
  ```
-->
        <div class="flex flex-col min-h-screen">
            <x-navadmin> </x-navadmin>

            <main class="flex-1">
                <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
                    <!-- Your content -->
                    @yield('content')
                </div>
            </main>

            <x-footeradmin></x-footeradmin>
        </div>

    </body>
</html>
