<!doctype html>
<html lang="ru">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <link rel="stylesheet" href="/css/bootstrap-utilities.css">
    <link rel="stylesheet" href="/css/style.css">
    <title>Материалы</title>
</head>
<body>
<div class="main-wrapper">
    <div class="content">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container">
                <a class="navbar-brand" href="/">Test</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <?php $url = explode("/", parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH)); ?>
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link <?php if ($url[1] == "materials") {echo "active";}?>" aria-current="page" href="/materials">Материалы</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php if ($url[1] == "tags") {echo "active";}?>" href="/tags">Теги</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php if ($url[1] == "categories") {echo "active";}?>" href="/categories">Категории</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>