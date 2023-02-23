<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/solid.css"
        integrity="sha384-Tv5i09RULyHKMwX0E8wJUqSOaXlyu3SQxORObAI08iUwIalMmN5L6AvlPX2LMoSE" crossorigin="anonymous" />
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/4.2.0/mdb.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
    <style>
        .badge {
            padding-left: 9px;
            padding-right: 9px;
            -webkit-border-radius: 9px;
            -moz-border-radius: 9px;
            border-radius: 9px;
        }

        .label-warning[href],
        .badge-warning[href] {
            background-color: #c67605;
        }

        #lblCartCount {
            font-size: 12px;
            background: #ff0000;
            color: #fff;
            padding: 0 5px;
            vertical-align: top;
            margin-left: -10px;
        }
    </style>
    @yield('css')
    <title>@yield('title')</title>
</head>

<body>
    {{-- Header Section --}}
    <section id="content-header">
        <!-- Navbar-->
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container justify-content-between">
                <!-- Left elements -->
                <div class="d-flex">
                    <!-- Brand -->
                    <a class="navbar-brand me-2 mb-1 d-flex align-items-center" href="{{ base_url('/') }}">
                        <b>Shop</b>Sooner
                    </a>
                    {{-- <ul class="navbar-nav w-auto my-auto d-none d-sm-flex">
                        
                    </ul> --}}
                </div>
                <!-- Left elements -->

                <!-- Center elements -->
                <ul class="navbar-nav flex-row d-none d-md-flex">
                    <li class="nav-item me-3 me-lg-1">
                        <a class="nav-link active" href="{{ base_url('/') }}">
                            Home
                        </a>
                    </li>
                    <li class="nav-item me-3 me-lg-1">
                        <a class="nav-link" href="{{ base_url('order') }}">
                            Riwayat Pemesanan
                        </a>
                    </li>
                </ul>
                <!-- Center elements -->

                <!-- Right elements -->
                <ul class="navbar-nav flex-row">
                    {{-- <li class="nav-item me-3 me-lg-1">
                        <a class="nav-link active" href="#">
                            Home
                        </a>
                    </li> --}}
                    @php
                        $cart = \Config\Services::cart();
                        $keranjang = $cart->contents();
                        $jml_item = 0;
                    @endphp
                    @foreach ($keranjang as $key => $value)
                        @php
                            $jml_item = $jml_item + $value['qty'];
                        @endphp
                    @endforeach
                    <li class="nav-item me-3 me-lg-1">
                        <a class="btn btn-link nav-link px-3 me-2" href="{{ base_url('cart') }}">
                            <i class="fas fa-shopping-cart fa-2x"></i>
                            @if($jml_item > 0)
                            <span class='badge badge-warning' id='lblCartCount'>{{ $jml_item }}</span>
                            @endif
                        </a>
                    </li>
                    @if (session()->get('user_logged_in'))
                        {{-- <li class="nav-item me-3 me-lg-1">
                            <a class="nav-link d-sm-flex align-items-sm-center" href="#">
                                
                            </a>
                        </li> --}}
                        <li class="nav-item dropdown me-3 me-lg-1">
                            <a class="nav-link dropdown-toggle d-sm-flex align-items-sm-center" href="#"
                                id="navbarDropdownMenuLink" role="button" data-mdb-toggle="dropdown"
                                aria-expanded="false">
                                <img src="https://0.gravatar.com/avatar/efed8ada19db5ae4e8c771cdf5d25253?s=32&amp;d=mm&amp;r=g&amp;s=24"
                                    class="avatar avatar-24 photo rounded-circle">
                                <strong class="d-none d-sm-block ms-1">{{ session()->get('nama') }}</strong>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownMenuLink">
                                <li>
                                    <form class="d-flex justify-content-end" action="{{ base_url('logout') }}"
                                        method="post">
                                        @php echo csrf_field(); @endphp
                                        <button class="dropdown-item">Logout</a>
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @else
                        <li class="nav-item me-3 me-lg-1">
                            <a class="btn btn-link nav-link px-3 me-2" href="{{ base_url('login') }}">
                                Login
                            </a>
                        </li>
                        <li class="nav-item me-3 me-lg-1">
                            <a class="btn btn-link nav-link me-3" href="{{ base_url('register') }}">
                                Register
                            </a>
                        </li>
                    @endif

                </ul>
                <!-- Right elements -->
            </div>
        </nav>
    </section>

    {{-- Body Section --}}
    <div class="mb-4"></div>
    <section id="content">
        @yield('content')
    </section>

    {{-- Footer Section --}}
    <div class="mb-10"></div>
    <section id="footer">
        <!-- Footer -->
        <footer class="text-center text-lg-start bg-light text-muted">
            <!-- Section: Social media -->
            <section class="d-flex justify-content-center justify-content-lg-between p-4 border-bottom">
            </section>
            <!-- Section: Social media -->

            <!-- Section: Links  -->
            <section class="">
                <div class="container text-center text-md-start mt-5">
                    <!-- Grid row -->
                    <div class="row mt-3">
                        <!-- Grid column -->
                        <div class="col-md-4 col-lg-5 col-xl-4 mx-auto mb-4">
                            <!-- Content -->
                            <h6 class="text-uppercase fw-bold mb-4">
                                <i class="fas fa-gem me-3"></i>ShopSooner
                            </h6>
                            <p>
                                Selamat Datang di ShopSooner, dan silahkan berbelanja hingga puas!
                            </p>
                        </div>
                        <!-- Grid column -->

                        <!-- Grid column -->
                        {{-- <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mb-4"> --}}
                            <!-- Links -->
                            {{-- <h6 class="text-uppercase fw-bold mb-4">
                                Products
                            </h6>
                            <p>
                                <a href="#!" class="text-reset">Angular</a>
                            </p>
                            <p>
                                <a href="#!" class="text-reset">React</a>
                            </p>
                            <p>
                                <a href="#!" class="text-reset">Vue</a>
                            </p>
                            <p>
                                <a href="#!" class="text-reset">Laravel</a>
                            </p> --}}
                        {{-- </div> --}}
                        <!-- Grid column -->

                        <!-- Grid column -->
                        <div class="col-md-4 col-lg-5 col-xl-3 mx-auto mb-4">
                            <!-- Links -->
                            <h6 class="text-uppercase fw-bold mb-4">
                                SHOPSOONER LINKS
                            </h6>
                            <p>
                                <a href="{{ base_url('/') }}" class="text-reset">Home</a>
                            </p>
                            <p>
                                <a href="{{ base_url('order') }}" class="text-reset">History</a>
                            </p>
                            <p>
                                <a href="{{ base_url('cart') }}" class="text-reset">Carts</a>
                            </p>
                        </div>
                        <!-- Grid column -->

                        <!-- Grid column -->
                        <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4">
                            <!-- Links -->
                            <h6 class="text-uppercase fw-bold mb-4">
                                Contact
                            </h6>
                            <p><i class="fas fa-home me-3"></i> A11.2021.13398</p>
                            <p>
                                <i class="fas fa-envelope me-3"></i>
                                A112113398@mhs.dinus.ac.id
                            </p>
                            <p><i class="fas fa-phone me-3"></i> +62 813 9079 2231</p>
                        </div>
                        <!-- Grid column -->
                    </div>
                    <!-- Grid row -->
                </div>
            </section>
            <!-- Section: Links  -->

            <!-- Copyright -->
            <div class="text-center p-4" style="background-color: rgba(0, 0, 0, 0.05);">
                © 2022 Copyright:
                <a class="text-reset fw-bold" href="{{ base_url('/') }}">Rayhan Ashlikh Rosyada</a>
            </div>
            <!-- Copyright -->
        </footer>
        <!-- Footer -->

    </section>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous">
    </script>
    <script defer src="https://use.fontawesome.com/releases/v5.15.4/js/all.js"
        integrity="sha384-rOA1PnstxnOBLzCLMcre8ybwbTmemjzdNlILg8O7z1lUkLXozs4DHonlDtnE7fpc" crossorigin="anonymous">
    </script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/4.2.0/mdb.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
    @yield('scripts')
</body>

</html>
