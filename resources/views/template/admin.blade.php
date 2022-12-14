<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.104.2">
    <title>{{ $title ?? 'Kegiatan Warga' }}</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.2/examples/dashboard/">

    <link href="/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.6.7/sweetalert2.css"
        integrity="sha512-JzSVRb7c802/njMbV97pjo1wuJAE/6v9CvthGTDxiaZij/TFpPQmQPTcdXyUVucsvLtJBT6YwRb5LhVxX3pQHQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
    <link href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet">
    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }

        .b-example-divider {
            height: 3rem;
            background-color: rgba(0, 0, 0, .1);
            border: solid rgba(0, 0, 0, .15);
            border-width: 1px 0;
            box-shadow: inset 0 .5em 1.5em rgba(0, 0, 0, .1), inset 0 .125em .5em rgba(0, 0, 0, .15);
        }

        .b-example-vr {
            flex-shrink: 0;
            width: 1.5rem;
            height: 100vh;
        }

        .bi {
            vertical-align: -.125em;
            fill: currentColor;
        }

        .nav-scroller {
            position: relative;
            z-index: 2;
            height: 2.75rem;
            overflow-y: hidden;
        }

        .nav-scroller .nav {
            display: flex;
            flex-wrap: nowrap;
            padding-bottom: 1rem;
            margin-top: -1px;
            overflow-x: auto;
            text-align: center;
            white-space: nowrap;
            -webkit-overflow-scrolling: touch;
        }

        .swal2-popup .swal2-styled:focus {
            box-shadow: none !important;
        }
    </style>
    <!-- Custom styles for this template -->
    <link href="/css/dashboard.css" rel="stylesheet">


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    @stack('jquery')
</head>

<body>

    <header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
        <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3 fs-6 text-uppercase text-center"
            href="/profile">{{ auth()->user()->nama ?? 'Admin' }}</a>
        <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse"
            data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false"
            aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <input class="form-control form-control-dark w-100 rounded-0 border-0" type="text" placeholder="Search"
            aria-label="Search">
        <div class="navbar-nav">
            <div class="nav-item text-nowrap">
                <form action="{{ route('logout') }}" method="post">
                    @csrf
                    <button class="nav-link px-3 py-0"
                        style="background-color: #212529; border-color: transparent !important;">Logout</button>
                </form>
            </div>
        </div>
    </header>

    <div class="container-fluid">
        <div class="row">
            <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
                <div class="position-sticky pt-3 sidebar-sticky">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('profile') ? 'active fw-bold fs-6' : '' }}"
                                aria-current="page" href="/profile">
                                <span class="align-text-bottom"></span>
                                <i class="bi bi-person-circle"></i> Profile
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('dashboard') ? 'active fw-bold fs-6' : '' }}"
                                aria-current="page" href="/dashboard">
                                <span class="align-text-bottom"></span>
                                <i class="bi bi-speedometer2"></i>
                                Dashboard
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('keuangan') ? 'active fw-bold fs-6' : '' }}"
                                href="/keuangan">
                                <span class="align-text-bottom"></span>
                                <i class="bi bi-wallet"></i>
                                Keuangan
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('activity') ? 'active fw-bold fs-6' : '' }}"
                                href="/activity">
                                <span class="align-text-bottom"></span>
                                <i class="bi bi-journal-text"></i> Kegiatan
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('identity') ? 'active fw-bold fs-6' : '' }}"
                                href="/identity">
                                <span class="align-text-bottom"></span>
                                <i class="bi bi-sliders2"></i> Setting Akun
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('structure') ? 'active fw-bold fs-6' : '' }}"
                                href="/structure">
                                <span class="align-text-bottom"></span>
                                <i class="bi bi-people-fill"></i> Struktur Organisasi
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('gallery') ? 'active fw-bold fs-6' : '' }}"
                                href="/gallery">
                                <span class="align-text-bottom"></span>
                                <i class="bi bi-image"></i> Galeri
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('gallery_slideshow') ? 'active fw-bold fs-6' : '' }}"
                                href="/gallery_slideshow">
                                <span class="align-text-bottom"></span>
                                <i class="bi bi-images"></i> Galeri SLideshow
                            </a>
                        </li>
                    </ul>


                </div>
            </nav>

            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <div class="row mt-3">
                    <div class="col-sm-12">
                        <div class="alert alert-secondary" role="alert">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="/profile"
                                            class="text-decoration-none">Home</a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">{{ request()->path() }}
                                    </li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
                <section>
                    <div class="alert alert-secondary">

                        @yield('container-admin')
                    </div>
                </section>
            </main>
        </div>
    </div>


    <script src="/dist/js/bootstrap.bundle.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js"
        integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js"
        integrity="sha384-zNy6FEbO50N+Cg5wap8IKA4M/ZnLJgzc6w2NqACZaK0u0FXfOWRRJOnQtpZun8ha" crossorigin="anonymous">
    </script>
    {{-- <script src="/js/dashboard.js"></script> --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.6.7/sweetalert2.min.js"
        integrity="sha512-jWnZswpC+en54H2EgAsmbQ6l+71tiRawlnmkw31sthq4EGzLKPXG3MQAGIUgWcw8jumkjPNHKHHS5odj+lHudw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
    <script>
        // document.getElementById("toastbtn").onclick = function() {
        var toastElList = [].slice.call(document.querySelectorAll('.toast'))
        var toastList = toastElList.map(function(toastEl) {
            // Creates an array of toasts (it only initializes them)
            return new bootstrap.Toast(toastEl) // No need for options; use the default options
        });
        toastList.forEach(toast => toast.show()); // This show them

        // console.log(toastList); // Testing to see if it works
        // };
    </script>
</body>

</html>
