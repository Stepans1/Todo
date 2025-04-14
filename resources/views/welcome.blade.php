<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TODO</title>
    @vite(['resources/js/app.js'])
</head>
<body class="bg-gray-100">
    <div id="app" data-statuses='@json($statuses)'></div>
</body>
</html>
