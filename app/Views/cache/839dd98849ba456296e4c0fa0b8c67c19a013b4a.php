

<?php $__env->startSection('title', 'Login'); ?>

<?php $__env->startSection('nav'); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
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
                                        <form action="<?php echo e(base_url('login')); ?>" method="POST">
                                            <input type="hidden" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" />
                                            <!-- Email input -->
                                            <div class="form-outline mb-4">
                                                <input type="text" id="username" name="username" class="form-control" value="<?php echo e(old('username')); ?>" />
                                                <label class="form-label" for="username"> Username atau Alamat Email</label>
                                            </div>

                                            <!-- Password input -->
                                            <div class="form-outline mb-4">
                                                <input type="password" id="password" name="password"
                                                    class="form-control" />
                                                <label class="form-label" for="password">Password</label>
                                            </div>

                                            <?php if(session()->getFlashdata('msg')): ?>
                                                <p class="text-danger"><?= session()->getFlashdata('msg') ?></p>
                                            <?php endif; ?>

                                            <!-- Submit button -->
                                            <button type="submit" class="btn btn-primary btn-block mb-4">
                                                Sign in
                                            </button>

                                            <div class="text-center">
                                                <p>Belum memiliki akun?<a href="<?php echo e(base_url('register')); ?>"> Registrasi
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
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.auth', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Kuliah\Kuliah\Semester 2\UAS\PWL\uaspwl\app\Views/auth/login.blade.php ENDPATH**/ ?>