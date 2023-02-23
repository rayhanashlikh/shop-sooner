

<?php $__env->startSection('title', 'Login'); ?>

<?php $__env->startSection('nav'); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    
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
                            
                            <div class="row d-flex justify-content-center">
                                <div class="col-lg-8">
                                    <h2 class="fw-bold mb-5">Registrasi User</h2>
                                    <form action="<?php echo e(base_url('register')); ?>" method="post">
                                        <input type="hidden" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>"/>
                                        <!-- 2 column grid layout with text inputs for the first and last names -->
                                        <div class="form-outline mb-4">
                                            <input type="text" id="nama" name="nama" class="form-control" value="<?php echo e(old('nama')); ?>" />
                                            <label class="form-label" for="nama">Nama Lengkap</label>
                                        </div>
    
                                        <!-- Email input -->
                                        <div class="form-outline mb-4">
                                            <input type="text" id="username" name="username" class="form-control" value="<?php echo e(old('username')); ?>">
                                            <label class="form-label" for="username">Username atau Alamat Email</label>
                                        </div>
    
                                        <!-- Password input -->
                                        <div class="form-outline mb-4">
                                            <input type="password" id="password" name="password" class="form-control" value="<?php echo e(old('password')); ?>"/>
                                            <label class="form-label" for="password">Password</label>
                                        </div>
    
                                        <!-- Submit button -->
                                        <button type="submit" class="btn btn-primary btn-block mb-4">
                                            Sign up
                                        </button>
    
                                        <!-- Register buttons -->
                                        <div class="text-center">
                                            <p>Sudah memiliki akun?<a href="<?php echo e(base_url('login')); ?>"> Login Sekarang! </a></p>
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
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.auth', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Kuliah\Kuliah\Semester 2\UAS\PWL\uaspwl\app\Views/auth/register.blade.php ENDPATH**/ ?>