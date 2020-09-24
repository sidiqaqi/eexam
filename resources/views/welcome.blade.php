<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700" rel="stylesheet">

        <link rel="stylesheet" href="{{ asset(mix('css/app.css')) }}">

    </head>
    <body class="antialiased">
        <div class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center sm:pt-0">
            <x-header></x-header>

            <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">

                <div class="mt-8 bg-white dark:bg-gray-800 overflow-hidden shadow sm:rounded-lg">
                    <div class="grid grid-cols-1 md:grid-cols-2">
                        <div class="p-6">
                            <div class="flex items-center text-xl">
                                <h1>Platform ujian online <br/> <strong class="d-block">Gratis untuk siapapun</strong></h1>
                            </div>

                            <div class="mt-2 text-gray-600 dark:text-gray-400 text-sm">
                                Platform ini menyediakan jasa ujian online yang ditujukan baik untuk pembuat soal maupun untuk peserta ujian itu sendiri.
                                Dan tentunya feature akan ditambahkan bertahap tergantung dengan minat para pengguna.
                            </div>
                        </div>

                        <div class="p-6 border-t border-gray-200 dark:border-gray-700 md:border-t-0 md:border-l">
                            <div class="ml-12">
                                <div class="mt-2 text-gray-600 dark:text-gray-400 text-sm">
                                    <pre> dasjd asdjasjldksal dklas jklsa jasj l aslj ljasas</pre>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="flex justify-center mt-4 sm:items-center sm:justify-between">
                    <div class="text-center text-sm text-gray-500 sm:text-left">
                        <div class="flex items-center">
                        </div>
                    </div>

                    <div class="ml-4 text-center text-sm text-gray-500 sm:text-right sm:ml-0">
                        Build v1
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
