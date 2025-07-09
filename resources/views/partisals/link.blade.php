<!--
    =========================================================
    * Project:   Your Project Name - Auth Page
    * Developer: Naushad (Your Name)
    * Date:      July 9, 2025
    =========================================================
    * This page features a responsive, single-page login and
    * registration form using Bootstrap 5.
    =========================================================
-->
<!doctype html>
<html lang="en">
<head>
    <!-- Required Meta Tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- SEO Meta Tags -->
    <title>@yield('title','Default Title')</title>
    <meta name="description" content="Securely log in or create an account to access your profile.">
    <meta name="keywords" content="login, register, account, authentication">
    <meta name="author" content="Naushad (Your Name)">

    <!-- Google Fonts (Poppins) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" xintegrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
    
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- Your Custom CSS (Should be last to override other styles) -->
     <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    @stack('style')
</head>
<body>