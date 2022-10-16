<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <!-- bootstrap -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.2.1/css/bootstrap.rtl.min.css"  />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet">

        <!--font awesome-->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"  />
        {{-- custom css --}}
        <style>
            .alert {
                position: relative;
                padding: 1.25rem 1.5rem;
                margin-bottom: 1rem;
                border: 1px solid transparent;
            }
            .alert-warning {
                background-color: #fbf0da;
                color: #73510d;
                font-size: 20px;
                font-weight: 700;
            }
            .alert-warning i{
                margin-right: 20px
            }
            .alert i[class^="bi-"]{
            font-size: 1.5em;
            line-height: 1;
            }
            .img-box img {
            width: 140px;
            height: 140px;
            border-radius: 50%;
            object-fit: cover;
            }
            .error{
                color: red;
                font-size: 14px;               
            }
            .profile-image{
                width:55px;
                height:55px;
                border-radius:50%;
                object-fit:cover;
                border:1px solid gray;
            }
            .modal-confirm {		
                color: #636363;
                width: 400px;
            }
            .modal-confirm .modal-content {
                padding: 20px;
                border-radius: 5px;
                border: none;
                text-align: center;
                font-size: 14px;
            }
            .modal-confirm .modal-header {
                border-bottom: none;   
                position: relative;
            }
            .modal-confirm h4 {
                text-align: center;
                font-size: 26px;
                margin: 30px 0 -10px;
            }
            .modal-confirm .close {
                position: absolute;
                top: -5px;
                right: -2px;
                border: none;
                font-size: 35px;
                background: white;
            }
            .modal-confirm .modal-body {
                color: #999;
            }
            .modal-confirm .modal-footer {
                border: none;
                text-align: center;		
                border-radius: 5px;
                font-size: 13px;
                padding: 10px 15px 25px;
            }
            .modal-confirm .modal-footer a {
                color: #999;
            }		
            .modal-confirm .icon-box {
                width: 80px;
                height: 80px;
                margin: 0 auto;
                border-radius: 50%;
                z-index: 9;
                text-align: center;
                border: 3px solid #f15e5e;
            }
            .modal-confirm .icon-box i {
                color: #f15e5e;
                font-size: 46px;
                display: inline-block;
                margin-top: 13px;
            }
            .modal-confirm .btn, .modal-confirm .btn:active {
                color: #fff;
                border-radius: 4px;
                background: #60c7c1;
                text-decoration: none;
                transition: all 0.4s;
                line-height: normal;
                min-width: 120px;
                border: none;
                min-height: 40px;
                border-radius: 3px;
                margin: 0 5px;
            }
            .modal-confirm .btn-secondary {
                background: #c1c1c1;
            }
            .modal-confirm .btn-secondary:hover, .modal-confirm .btn-secondary:focus {
                background: #a8a8a8;
            }
            .modal-confirm .btn-danger {
                background: #f15e5e;
            }
            .modal-confirm .btn-danger:hover, .modal-confirm .btn-danger:focus {
                background: #ee3535;
            }
            .trigger-btn {
                display: inline-block;
                margin: 100px auto;
            }
         /* viesing code  */
         .gradient-custom {
            /* fallback for old browsers */
            background: #f6d365;

            /* Chrome 10-25, Safari 5.1-6 */
            background: -webkit-linear-gradient(to right bottom, rgba(246, 211, 101, 1), rgba(253, 160, 133, 1));

            /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
            background: linear-gradient(to right bottom, rgba(246, 211, 101, 1), rgba(253, 160, 133, 1))
             }
            .col-md-4.gradient-custom.text-center.text-white {
                align-items: center;
                display: flex;
                flex-direction: column;
                justify-content: center;
            }
            .post-title{
                color: black;
                font-weight: 700;
                font-size: 18px;
            }
        </style>
        <!-- Styles -->
        <!-- Styles -->
        @livewireStyles
    </head>
    <body class="font-sans antialiased">
        <x-jet-banner />

        <div class="min-h-screen bg-gray-100">
            @livewire('navigation-menu')

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

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
        @stack('modals')
        @livewireScripts
    </body>
</html>
