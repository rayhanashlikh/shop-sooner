

<?php $__env->startSection('css'); ?>
    <style>
        .card-img-top {
            width: 100%;
            height: 15vw;
            object-fit: cover;
        }
    </style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('title', 'Home'); ?>

<?php $__env->startSection('content'); ?>
    <div class="container">
        
        <div class="row">
            <div class="col-12">
                <form style="position: sticky; display: flex; width: 100%;">
                    <div class="input-group mb-3">
                        <input type="search" id="form1" name="search" style="min-height: auto !important;"
                            class="form-control" placeholder="Temukan Barang">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-search"></i> Cari
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <?php if(session()->getFlashdata('msg')): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Sukses!</strong> Barang telah berhasil ditambahkan ke keranjang !!!.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        
        <div id="carouselExampleIndicators" class="carousel slide mb-5" data-mdb-ride="carousel">
            <div class="carousel-indicators">
                <button type="button" data-mdb-target="#carouselExampleIndicators" data-mdb-slide-to="0" class="active"
                    aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-mdb-target="#carouselExampleIndicators" data-mdb-slide-to="1"
                    aria-label="Slide 2"></button>
                <button type="button" data-mdb-target="#carouselExampleIndicators" data-mdb-slide-to="2"
                    aria-label="Slide 3"></button>
            </div>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="https://mdbcdn.b-cdn.net/img/new/slides/041.webp" class="d-block w-100"
                        alt="Wild Landscape" />
                </div>
                <div class="carousel-item">
                    <img src="https://mdbcdn.b-cdn.net/img/new/slides/042.webp" class="d-block w-100" alt="Camera" />
                </div>
                <div class="carousel-item">
                    <img src="https://mdbcdn.b-cdn.net/img/new/slides/043.webp" class="d-block w-100" alt="Exotic Fruits" />
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-mdb-target="#carouselExampleIndicators"
                data-mdb-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-mdb-target="#carouselExampleIndicators"
                data-mdb-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
        <h1 class="text-center mb-5">Produk Kami</h1>
        
        <div class="row row-cols-1 row-cols-md-4 g-4">
            <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dt): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="col mx-auto">
                    <form action="<?php echo e(base_url('cart/add')); ?>" method="post">
                        <?php echo csrf_field() ?>
                        <input type="hidden" name="id" value="<?php echo e($dt['id']); ?>" style="display:none">
                        <input type="hidden" name="price" value="<?php echo e($dt['harga']); ?>" style="display:none">
                        <input type="hidden" name="name" value="<?php echo e($dt['nama']); ?>" style="display:none">
                        <input type="hidden" name="gambar" value="<?php echo e($dt['gambar']); ?>" style="display:none">
                        <input type="hidden" name="berat" value="<?php echo e($dt['berat']); ?>" style="display:none">
                        <div class="card h-100">
                            <img src="<?php echo e(base_url('images/uploads/' . $dt['gambar'])); ?>" class="card-img-top"
                                alt="<?php echo e($dt['gambar']); ?>" />
                            <div class="card-body mx-auto">
                                <h5 class="card-title mb-3"><?php echo e($dt['nama']); ?></h5>
                                <div class="d-flex justify-content-center">
                                    <span class="badge badge-pill badge-warning mb-3">Rp
                                        <?php echo e(number_format($dt['harga'], 2, ',', '.')); ?></span>
                                </div>
                            </div>
                            <div class="card-footer">
                                <div class="d-flex justify-content-center">
                                    <div class="btn-group">
                                        <button type="submit" class="btn btn-success"><i
                                                class="fas fa-shopping-cart"></i> Add to
                                            Cart</button>
                                        <a href="<?php echo e(base_url('detail/' . $dt['id'])); ?>" class="btn btn-primary">
                                            Detail</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Kuliah\Kuliah\Semester 2\UAS\PWL\uaspwl\app\Views/barang/home.blade.php ENDPATH**/ ?>