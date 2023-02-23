

<?php $__env->startSection('title', 'Cart'); ?>

<?php $__env->startSection('content'); ?>
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Keranjang</h3>
            </div>
            <div class="card-body">
                <input type="hidden" class="txt_csrfname" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" />
                <div class="container mb-2 mt-3">
                    <div class="container">
                        <div class="row my-2 mx-1 justify-content-center table-responsive">
                            <table class="table table-striped table-borderless" id="cart-table">
                                <thead style="background-color:#84B0CA ;" class="text-white">
                                    <tr>
                                        <th scope="col">Jumlah</th>
                                        <th scope="col">Nama Barang</th>
                                        <th scope="col">Harga</th>
                                        <th scope="col">Berat</th>
                                        <th scope="col">Total</th>
                                        <th scope="col">Delete</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $total_berat = 0;
                                        $total_harga = 0;
                                        $total_jumlah = 0;
                                    ?>
                                    <?php $__currentLoopData = $data['cart']->contents(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cart): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php
                                            $total_berat = $total_berat + $cart['qty'] * $cart['options']['berat'];
                                            $total_harga = $total_harga + $cart['qty'] * $cart['price'];
                                            $total_jumlah = $total_jumlah + $cart['qty'];
                                        ?>
                                        <tr>
                                            <th><input type="number" id="<?php echo e($cart['rowid']); ?>" min="1"
                                                    name="qty" class="form-control" value="<?php echo e($cart['qty']); ?>"></th>
                                            <td><?php echo e($cart['name']); ?></td>
                                            <td>Rp<?php echo e(number_format($cart['price'], 2, ',', '.')); ?></td>
                                            <td><?php echo e($cart['options']['berat']); ?></td>
                                            <td>Rp<?php echo e(number_format($cart['qty'] * $cart['price'], 2, ',', '.')); ?></td>
                                            <td>
                                                <button onClick="deleteCart('<?php echo e($cart['rowid']); ?>')"
                                                    class="btn btn-danger"><i class="fa fa-times fa-1x"></i></button>
                                            </td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="row">
                            <div class="col-sm-8">
                                

                            </div>
                            <div class="col-sm-4">
                                <table class="table table-striped">
                                    <tr>
                                        <td class="text-muted ms-3"><span class="text-black me-4">SubTotal</span></td>
                                        <td>Rp<?php echo e(number_format($total_harga, 2, ',', '.')); ?></td>
                                    </tr>
                                    <tr>
                                        <td class="text-muted ms-3"><span class="text-black me-4">Berat Total</span></td>
                                        <td><?php echo e($total_berat); ?> gram</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <form action="<?php echo e(base_url('order/checkout')); ?>" method="post">
                                <?php echo csrf_field(); ?>
                                <input type="hidden" name="total_jumlah" value="<?php echo e($total_jumlah); ?>" style="display:none">
                                <input type="hidden" name="total_harga" value="<?php echo e($total_harga); ?>" style="display:none">
                                <input type="hidden" name="total_berat" value="<?php echo e($total_berat); ?>" style="display:none">
                                <div class="col-xl-9">
                                </div>
                                <div class="col-xl-3">
                                    <div class="btn-group">
                                        <a href="<?php echo e(base_url('/')); ?>" class="btn btn-primary text-capitalize"><i
                                                class="fa fa-arrow-left"></i> Lanjut Belanja</a>
                                        <button type="submit" class="btn btn-success text-capitalize"><i
                                                class="fas fa-credit-card"></i> Checkout</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
    <script>
        function deleteCart(id) {
            // var id = String(id);
            event.preventDefault();
            console.log(id);
            $.ajax({
                method: 'POST',
                url: '<?= base_url("cart/delete") ?>',
                data: {rowid: id},
                dataType: 'json',
                success: function(data) {
                    alert('Something went wrong');
                },
                error: function(data) {
                    $('#cart-table').DataTable().draw();
                    window.location.reload(true);
                }
            })
        }

        $(document).ready(function() {
            $('#cart-table').dataTable();

            $('.form-control').change(function(e) {
                e.preventDefault();
                var id = $(this).attr('id');
                var value = $(this).val();
                var csrfName = $('.txt_csrfname').attr('name'); // CSRF Token name
                var csrfHash = $('.txt_csrfname').val(); // CSRF hash

                $.ajax({
                    method: 'POST',
                    url: '<?= base_url('cart/update') ?>',
                    data: {
                        rowid: id,
                        qty: value
                    },
                    dataType: 'json',
                    success: function(data) {
                        alert('Something went wrong');
                    },
                    error: function(data) {
                        $('#cart-table').DataTable().draw();
                        window.location.reload(true);
                    }
                });
            });
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Kuliah\Kuliah\Semester 2\UAS\PWL\uaspwl\app\Views/cart/index.blade.php ENDPATH**/ ?>