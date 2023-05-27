@extends('layouts.auth')

@section('title', 'Login')

@section('nav')

@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-2"></div>
            <div class="col-8">
                <!-- Section: Design Block -->
                <section class="text-center text-lg-start">
                    <style>
                        .cascading-right {
                            margin-right: -50px;
                        }

                        @media (max-width: 991.98px) {
                            .cascading-right {
                                margin-right: 0;
                            }
                        }
                    </style>

                    <!-- Jumbotron -->
                    <div class="container py-4">
                        <div class="row g-0 align-items-center">
                            <div class="col-lg-6 mb-5 mb-lg-0">
                                <div class="card cascading-right"
                                    style="background: hsla(0, 0%, 100%, 0.55);
                                        backdrop-filter: blur(30px);">
                                    <div class="card-body p-5 shadow-5 text-center">
                                        <h2 class="fw-bold mb-5">Sign In</h2>
                                        <form action="{{ base_url('login') }}" method="POST">
                                            <input type="hidden" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" />
                                            <!-- Email input -->
                                            <div class="form-outline mb-4">
                                                <input type="text" id="username" name="username" class="form-control"
                                                    value="{{ old('username') }}" />
                                                <label class="form-label" for="username"> Username atau Alamat Email</label>
                                            </div>

                                            <!-- Password input -->
                                            <div class="form-outline mb-4 input-group">
                                                <input type="password" id="password" name="password"
                                                    class="form-control" />
                                                <label class="form-label" for="password">Password</label>
                                                <span id="togglePassword" class="input-group-text"><i id="eye-pass"
                                                        class="fas fa-eye"></i></span>
                                            </div>

                                            @if (session()->getFlashdata('msg'))
                                                <p class="text-danger"><?= session()->getFlashdata('msg') ?></p>
                                            @endif

                                            <!-- Submit button -->
                                            <button type="submit" class="btn btn-primary btn-block mb-4">
                                                Sign in
                                            </button>

                                            <div class="text-center">
                                                <p>Belum memiliki akun?<a href="{{ base_url('register') }}"> Registrasi
                                                        Sekarang!</a> </p>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6 mb-5 mb-lg-0">
                                <img src="https://mdbootstrap.com/img/new/ecommerce/vertical/004.jpg"
                                    class="w-100 rounded-4 shadow-4" alt="" />
                            </div>
                        </div>
                    </div>
                    <!-- Jumbotron -->
                </section>
                <!-- Section: Design Block -->
            </div>
            <div class="col-2"></div>
        </div>

    </div>
@endsection

@section('scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            $("#togglePassword").click(function() {
                // console.log('test1');
                $(this).find("#eye-pass").toggleClass("fa-eye fa-eye-slash");
                var input = $("#password");
                if (input.attr("type") === "password") {
                    input.attr("type", "text");
                } else {
                    input.attr("type", "password");
                }
            });
        })
    </script>
@endsection
