@extends('layouts.auth')

@section('title', 'Login')

@section('nav')

@endsection

@section('content')
    {{-- <div class="container"> --}}
    <!-- Section: Design Block -->
    <section class="text-center">
        <!-- Background image -->
        <div class="p-5 bg-image"
            style="background-image: url('https://mdbootstrap.com/img/new/textures/full/171.jpg');
                            height: 300px;">
        </div>
        <div class="container">
            <div class="row">
                <div class="col-1"></div>
                <div class="col-10">
                    <!-- Background image -->
                    <div class="card mx-4 mx-md-5 shadow-5-strong"
                        style="margin-top: -100px;
                                    background: hsla(0, 0%, 100%, 0.8);
                                    backdrop-filter: blur(30px);">
                        <div class="card-body py-5 px-md-5">
                            {{-- @php
                            dd($cek);
                            @endphp --}}
                            <div class="row d-flex justify-content-center">
                                <div class="col-lg-8">
                                    <h2 class="fw-bold mb-5">Registrasi User</h2>
                                    <form action="{{ base_url('register') }}" method="post">
                                        <input type="hidden" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>"/>
                                        <!-- 2 column grid layout with text inputs for the first and last names -->
                                        <div class="form-outline mb-4">
                                            <input type="text" id="nama" name="nama" class="form-control" value="{{old('nama')}}" />
                                            <label class="form-label" for="nama">Nama Lengkap</label>
                                        </div>
    
                                        <!-- Email input -->
                                        <div class="form-outline mb-4">
                                            <input type="text" id="username" name="username" class="form-control" value="{{old('username')}}">
                                            <label class="form-label" for="username">Username atau Alamat Email</label>
                                        </div>
    
                                        <!-- Password input -->
                                        <div class="form-outline mb-4">
                                            <input type="password" id="password" name="password" class="form-control" value="{{old('password')}}"/>
                                            <label class="form-label" for="password">Password</label>
                                        </div>
    
                                        <!-- Submit button -->
                                        <button type="submit" class="btn btn-primary btn-block mb-4">
                                            Sign up
                                        </button>
    
                                        <!-- Register buttons -->
                                        <div class="text-center">
                                            <p>Sudah memiliki akun?<a href="{{ base_url('login') }}"> Login Sekarang! </a></p>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-1"></div>
            </div>
        </div>
    </section>
    <!-- Section: Design Block -->
@endsection
