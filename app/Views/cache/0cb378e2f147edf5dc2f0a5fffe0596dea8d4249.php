

<?php $__env->startSection('title', 'Daftar Order'); ?>

<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Daftar Order</h3>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-hover" id="order-table">
                    <thead class="table-primary">
                        <tr>
                            <th>No</th>
                            <th>Tanggal Order</th>
                            <th>Jumlah Barang</th>
                            <th>Total Harga</th>
                            <th>Status</th>
                            <th>Detail</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; ?>
                        <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dt): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($no); ?></td>
                            <td><?php echo e($dt['tgl_pesan']); ?></td>
                            <td><?php echo e($dt['total_jumlah']); ?></td>
                            <td>Rp<?php echo e(number_format($dt['total_harga'], 2, ',', '.')); ?></td>
                            <td><?php echo e($dt['status']); ?></td>
                            <td>
                                <a href="<?php echo e(base_url('order/confirm-checkout/'. $dt['id'])); ?>" class="btn btn-primary">Detail Order</a>
                            </td>
                        </tr>
                        <?php $no++; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
<script>
    $(document).ready(function () {
        $('#order-table').dataTable();
    });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts/main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Kuliah\Kuliah\Semester 2\UAS\PWL\uaspwl\app\Views/orders/index.blade.php ENDPATH**/ ?>