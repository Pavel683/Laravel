<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<h1>Vue</h1><a href="{{ route('cache_clear') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Очистить кеш</a>
    <div id="app">  <!-- Подключаем vue компоненту -->
        <TestingHome></TestingHome>
    </div>
</body>
<script src="/js/app.js"></script>
</html>
