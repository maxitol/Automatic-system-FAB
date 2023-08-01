<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

        <title>{{ config('app.name', 'ФЭБ') }}</title>
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
    <link rel="stylesheet" href="https://snipp.ru/cdn/select2/4.0.13/dist/css/select2.min.css">
   <script src="https://snipp.ru/cdn/jquery/2.1.1/jquery.min.js"></script>
   <script src="https://snipp.ru/cdn/select2/4.0.13/dist/js/select2.min.js"></script>
   <script src="https://snipp.ru/cdn/select2/4.0.13/dist/js/i18n/ru.js"></script>
    <script>

    </script>
   <!--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.13.3/css/selectize.bootstrap4.min.css">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.13.3/js/standalone/selectize.min.js"></script>
  <script>
      // Инициализируем Selectize.js при загрузке документа
      $(document).ready(function() {
          // Находим элемент селекта по id
          let select = $(".search-select");
          // Применяем к нему плагин Selectize.js с настройками
          select.selectize({
              // Задаем текст-подсказку
              // Задаем максимальное количество выбранных опций
              // Задаем язык интерфейса
              lang: "ru",
              width: '100%',
              // Задаем родителя для выпадающего списка

          });
      });
  </script>-->

        <div class="min-h-screen bg-gray-100">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>
    </body>
</html>
