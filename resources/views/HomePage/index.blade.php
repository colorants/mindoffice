<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="has-background-black">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.4/css/bulma.min.css">
    <link rel="stylesheet" href="css/app.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Rubik:wght@300;400;500;700&display=swap" rel="stylesheet">

</head>

<h1 class="has-text-white mt-3 has-text-centered is-size-1">
    Blips // Home Page
</h1>

<nav class="navbar mt-3 " role="navigation" aria-label="main navigation">


    <div id="navbar" class="navbar-menu has-background-black " >
        <div class="navbar-start ml-auto has-text-white">
            <a class="navbar-item has-text-white">
                Home
            </a>

            <a class="navbar-item has-text-white">
                Profile
            </a>

            <a class="navbar-item has-text-white">
                Log-in
            </a>
        </div>

    </div>
</nav>
</html>
