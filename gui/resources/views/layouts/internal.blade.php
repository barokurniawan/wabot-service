<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover" />
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Dashboard - Tabler - Premium and Open Source dashboard template with responsive and high quality UI.</title>
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
    <meta name="msapplication-TileColor" content="#206bc4" />
    <meta name="theme-color" content="#206bc4" />
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent" />
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="mobile-web-app-capable" content="yes" />
    <meta name="HandheldFriendly" content="True" />
    <meta name="MobileOptimized" content="320" />
    <meta name="robots" content="noindex,nofollow,noarchive" />
    <link rel="icon" href="./favicon.ico" type="image/x-icon" />
    <link rel="shortcut icon" href="./favicon.ico" type="image/x-icon" />
    <!-- CSS files -->
    <link href="{{ asset('theme/tabler/dist/libs/jqvmap/dist/jqvmap.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('theme/tabler/dist/css/tabler.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('theme/tabler/dist/css/demo.min.css') }}" rel="stylesheet" />
    <style>
        body {
            display: none;
        }
    </style>
</head>

<body class="antialiased">
    <div class="page">
        {{-- HEADER --}}
        <header class="navbar navbar-expand-md navbar-light">
            <div class="container-xl">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-menu">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <a href="{{ route('main_page') }}" class="navbar-brand navbar-brand-autodark d-none-navbar-horizontal pr-0 pr-md-3">
                    <img src="{{ asset('theme/tabler/static/logo.svg') }}" alt="Tabler" class="navbar-brand-image">
                </a>
                <div class="navbar-nav flex-row order-md-last">
                    {{-- <div class="nav-item dropdown d-none d-md-flex mr-3">
                        <a href="#" class="nav-link px-0" data-toggle="dropdown" tabindex="-1">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" />
                                <path
                                    d="M10 5a2 2 0 0 1 4 0a7 7 0 0 1 4 6v3a4 4 0 0 0 2 3h-16a4 4 0 0 0 2 -3v-3a7 7 0 0 1 4 -6" />
                                <path d="M9 17v1a3 3 0 0 0 6 0v-1" /></svg>
                            <span class="badge bg-red"></span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-card">
                            <div class="card">
                                <div class="card-body">
                                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusamus ad amet
                                    consectetur exercitationem fugiat in ipsa ipsum, natus odio quidem quod repudiandae
                                    sapiente. Amet debitis et magni maxime necessitatibus ullam.
                                </div>
                            </div>
                        </div>
                    </div> --}}
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link d-flex lh-1 text-reset p-0" data-toggle="dropdown">
                            <span class="avatar" style="background-image: url({{ asset('theme/tabler/static/avatars/000m.jpg') }})"></span>
                            <div class="d-none d-xl-block pl-2">
                                <div>Paweł Kuna</div>
                                <div class="mt-1 small text-muted">UI Designer</div>
                            </div>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item" href="#">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon dropdown-item-icon" width="24"
                                    height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" />
                                    <path
                                        d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 0 0 2.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 0 0 1.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 0 0 -1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 0 0 -2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 0 0 -2.573 -1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 0 0 -1.065 -2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 0 0 1.066 -2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                                    <circle cx="12" cy="12" r="3" /></svg>
                                Action
                            </a>
                            <a class="dropdown-item" href="#">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon dropdown-item-icon" width="24"
                                    height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" />
                                    <path d="M9 7 h-3a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-3" />
                                    <path d="M9 15h3l8.5 -8.5a1.5 1.5 0 0 0 -3 -3l-8.5 8.5v3" />
                                    <line x1="16" y1="5" x2="19" y2="8" /></svg>
                                Another action
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#"><svg xmlns="http://www.w3.org/2000/svg"
                                    class="icon dropdown-item-icon" width="24" height="24" viewBox="0 0 24 24"
                                    stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                                    stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" />
                                    <line x1="12" y1="5" x2="12" y2="19" />
                                    <line x1="5" y1="12" x2="19" y2="12" /></svg>
                                Separated link</a>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        {{-- NAV MENU --}}
        <div class="navbar-expand-md">
            <div class="collapse navbar-collapse" id="navbar-menu">
                <div class="navbar navbar-light">
                    <div class="container-xl">
                        <ul class="navbar-nav">
                            <li class="nav-item active">
                                <a class="nav-link" href="./index.html">
                                    <span class="nav-link-icon d-md-none d-lg-inline-block"><svg
                                            xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                            viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                            stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" />
                                            <polyline points="5 12 3 12 12 3 21 12 19 12" />
                                            <path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7" />
                                            <path d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v6" /></svg>
                                    </span>
                                    <span class="nav-link-title">
                                        Home
                                    </span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="./form-elements.html">
                                    <span class="nav-link-icon d-md-none d-lg-inline-block"><svg
                                            xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                            viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                            stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" />
                                            <polyline points="9 11 12 14 20 6" />
                                            <path
                                                d="M20 12v6a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2h9" />
                                        </svg>
                                    </span>
                                    <span class="nav-link-title">Device</span>
                                </a>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#navbar-docs" data-toggle="dropdown"
                                    role="button" aria-expanded="false">
                                    <span class="nav-link-icon d-md-none d-lg-inline-block">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" />
                                            <polyline points="14 3 14 8 19 8" />
                                            <path d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z" />
                                            <line x1="9" y1="9" x2="10" y2="9" />
                                            <line x1="9" y1="13" x2="15" y2="13" />
                                            <line x1="9" y1="17" x2="15" y2="17" /></svg>
                                    </span>
                                    <span class="nav-link-title">Docs</span>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-columns  dropdown-menu-columns-3">
                                    <li><a class="dropdown-item" href="./docs/avatars.html">API Docs</a></li>
                                </ul>
                            </li>
                        </ul>
                        <div class="my-2 my-md-0 flex-grow-1 flex-md-grow-0 order-first order-md-last">
                            <form action="." method="get">
                                <div class="input-icon">
                                    <span class="input-icon-addon">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                            viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                            stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" />
                                            <circle cx="10" cy="10" r="7" />
                                            <line x1="21" y1="21" x2="15" y2="15" /></svg>
                                    </span>
                                    <input type="text" class="form-control" placeholder="Search…">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- CONTENT --}}
        <div class="content">
            @yield('content')
            <footer class="footer footer-transparent">
                <div class="container">
                    <div class="row text-center align-items-center flex-row-reverse">
                        <div class="col-lg-auto ml-lg-auto">
                            <ul class="list-inline list-inline-dots mb-0">
                                <li class="list-inline-item"><a href="./docs/index.html"
                                        class="link-secondary">Documentation</a></li>
                                <li class="list-inline-item"><a href="./faq.html" class="link-secondary">FAQ</a></li>
                                <li class="list-inline-item"><a href="https://github.com/tabler/tabler" target="_blank"
                                        class="link-secondary">Source code</a></li>
                            </ul>
                        </div>
                        <div class="col-12 col-lg-auto mt-3 mt-lg-0">
                            Copyright © 2020
                            <a href="." class="link-secondary">Tabler</a>.
                            All rights reserved.
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>

    <!-- Libs JS -->
    <script src="{{ asset('theme/tabler/dist/libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('theme/tabler/dist/libs/jquery/dist/jquery.slim.min.js') }}"></script>
    <script src="{{ asset('theme/tabler/dist/libs/apexcharts/dist/apexcharts.min.js') }}"></script>
    <script src="{{ asset('theme/tabler/dist/libs/jqvmap/dist/jquery.vmap.min.js') }}"></script>
    <script src="{{ asset('theme/tabler/dist/libs/jqvmap/dist/maps/jquery.vmap.world.js') }}"></script>
    <script src="{{ asset('theme/tabler/dist/libs/peity/jquery.peity.min.js') }}"></script>
    <script src="{{ asset('theme/tabler/dist/js/tabler.min.js') }}"></script>
    <script>
        document.body.style.display = "block"
    </script>
</body>

</html>