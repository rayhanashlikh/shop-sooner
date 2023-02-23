

<?php $__env->startSection('css'); ?>
    <style>
        img#img-detail {
            float: left;
            width: 300px;
            height: 300px;
        }

        td.colon {
            padding-left: 1rem;
            padding-right: 1rem;
        }
    </style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('title', 'Detail Barang'); ?>

<?php $__env->startSection('content'); ?>
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    Detail Produk
                </h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <img id="img-detail" class="image-responsive"
                            src="<?php echo e(base_url('images/uploads/' . $data['gambar'])); ?>" alt="<?php echo e($data['gambar']); ?>">
                    </div>
                    <div class="col-md-8">
                        <form action="<?php echo e(base_url('cart/add')); ?>" method="post">
                            <?php echo csrf_field() ?>
                            <input type="hidden" name="id" value="<?php echo e($data['id']); ?>" style="display:none">
                            <input type="hidden" name="price" value="<?php echo e($data['harga']); ?>" style="display:none">
                            <input type="hidden" name="name" value="<?php echo e($data['nama']); ?>" style="display:none">
                            <input type="hidden" name="gambar" value="<?php echo e($data['gambar']); ?>" style="display:none">
                            <input type="hidden" name="berat" value="<?php echo e($data['berat']); ?>" style="display:none">
                            <h5 class="card-title"><?php echo e($data['nama']); ?></h5>
                            <small>Terjual 3rb+</small>
                            <div class="mb-3"></div>
                            <h3 class="card-title mb-3">Rp<?php echo e(number_format($data['harga'], 2, ',', '.')); ?></h3>
                            <hr>
                            <div class="table-responsive">
                                <table>
                                    <tbody>
                                        <tr>
                                            <td>Lokasi</td>
                                            <td class="colon"> : </td>
                                            <td><?php echo e($kota); ?></td>
                                        </tr>
                                        <tr>
                                            <td>Berat</td>
                                            <td class="colon"> : </td>
                                            <td><?php echo e($data['berat']); ?> (gram)</td>
                                        </tr>
                                        <tr>
                                            <td>Stok Barang</td>
                                            <td class="colon"> : </td>
                                            <td><?php echo e($data['jumlah']); ?></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="mb-3"></div>
                            <p><?php echo e($data['deskripsi']); ?></p>
                            <div class="d-inline">
                                <button type="submit" class="btn btn-success"><i class="fas fa-shopping-cart"></i> Add to
                                    Cart</button>
                                <a href="<?php echo e(base_url('/')); ?>" class="btn btn-primary">
                                    Back</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="card-footer">

            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Kuliah\Kuliah\Semester 2\UAS\PWL\uaspwl\app\Views/barang/detail.blade.php ENDPATH**/ ?>