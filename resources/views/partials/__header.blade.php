<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>University Clinic Management System</title>

    {{-- ------------------------- Tailwind -------------------------------- --}}
    @vite('resources/css/app.css')

    {{-- -------------------------- CSRF ---------------------------------  --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- JQUESRY AND FONT AWESOMWE CDN LINKS --}}
    <script src="https://kit.fontawesome.com/eb33044df0.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    {{-- ----------------------- FONTS ------------------------------------ --}}
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@300&display=swap" rel="stylesheet">


    {{-- ------------------------------- CSS ----------------------------------------------- --}}


    {{-- -----------------------------JQUERY---------------------------------------------- --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    {{-----------------------------Script ----------------------------------------------------}}


    <script src="{{asset('asset/js/datatable/datatables.min.js')}}"></script>
    <link rel="stylesheet" href="{{asset('asset/js/datatable/datatables.min.css')}}">

    <link rel="stylesheet" href="{{asset('asset/js/time/jquery.timepicker.css')}}">
    <script src="{{asset('asset/js/time/jquery.timepicker.js')}}"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
