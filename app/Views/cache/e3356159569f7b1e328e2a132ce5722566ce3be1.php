

<?php $__env->startSection('title', 'Konfirmasi Pemesanan'); ?>

<?php $__env->startSection('content'); ?>
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    Konfirmasi Pesanan Anda
                </h3>
            </div>
            <form action="<?php echo e(base_url('order/confirm-order/'. $data['id'])); ?>" method="post">
            <div class="card-body">
                    <?php echo csrf_field(); ?>
                    <input type="hidden" name="_method" value="PATCH">
                    <div class="form-group mb-3">
                        <label for="nama">Nama User</label>
                        <input type="text" id="nama" class="form-control" value="<?php echo e($user['nama']); ?>" readonly>
                    </div>
                    <div class="form-group mb-3">
                        <div class="row">
                            <div class="col-md-6 col-sm-12">
                                <label for="provinsi">Provinsi</label>
                                <select class="form-select" aria-label="Pilih Provinsi" name="provinsi" id="provinsi">
                                    <option selected>Pilih Provinsi</option>
                                    <?php $__currentLoopData = $allProvinsi; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($p['province_id']); ?>"><?php echo e($p['province']); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <label for="kota">Kota</label>
                                <select class="form-select" aria-label="Pilih Kota" name="kota" id="kota">
                                    <option selected>Pilih Kota</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group mb-3">
                        <div class="row">
                            <div class="col-md-6 col-sm-12">
                                <label for="kurir">Kurir</label>
                                <select class="form-select" aria-label="Pilih Kurir" name="kurir" id="kurir">
                                    <option selected>Pilih Kurir</option>
                                    <option value="jne">JNE</option>
                                    <option value="pos">POS</option>
                                    <option value="tiki">Tiki</option>
                                </select>
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <label for="layanan">Layanan Kurir</label>
                                <select class="form-select" aria-label="Pilih layanan" name="layanan" id="layanan">
                                    <option selected>Pilih Layanan Kurir</option>
                                </select>
                            </div>
                            <input type="hidden" name="total_harga" id="total_harga">
                        </div>
                    </div>
                    <div class="form-group mb-3">
                        <label for="metode_pembayaran">Metode Pembayaran</label>
                        <select class="form-select" aria-label="Pilih metode_pembayaran" name="metode_pembayaran" id="metode_pembayaran">
                            <option selected>Pilih Metode Pembayaran</option>
                            <option value="BCA-12345678">BCA</option>
                            <option value="Mandiri-12345678">Mandiri</option>
                            <option value="Visa-12345678">Visa</option>
                        </select>
                    </div>
                    <div class="form-group mb-3">
                        <label for="alamat">Alamat</label>
                        <textarea type="text" name="alamat" id="alamat" class="form-control" placeholder="Masukkan Alamat Lengkap"></textarea>
                    </div>
                    <div class="row">
                        <div class="col-md-8"></div>
                        <div class="col-md-4">
                            <table class="table table-striped">
                                <tr>
                                    <th>Subtotal</th>
                                    <td><?php echo e($data['total_harga']); ?></td>
                                </tr>
                                <tr>
                                    <th>Ongkir</th>
                                    <td id="ongkir"></td>
                                </tr>
                                <tr>
                                    <th>Total Harga</th>
                                    <td id="harga-final"></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary">Konfirmasi Pemesanan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
    <script>
        function arrLen(arr, count) {
            if (count == undefined) {
                return arrLen(arr, 1)
            }

            if (!arr[count]) {
                return count;
            }

            return arrLen(arr, add(count, 1));
        }

        $(document).ready(function() {
            $('#provinsi').change(function() {
                var province_id = $(this).val();
                if (province_id != '') {
                    $.ajax({
                        url: '<?= base_url('order/get-kota') ?>',
                        method: 'GET',
                        data: {
                            province_id: province_id
                        },
                        dataType: 'json',
                        success: function(data) {
                            var html = '<option selected>Pilih Kota</option>';

                            for (var count = 0; count < data.length; count++) {

                                html += '<option value="' + data[count].city_id + '">' + data[
                                    count].city_name + '</option>';
                            }

                            $('#kota').html(html);
                        }
                    });
                }
            });

            $('#kurir').change(function() {
                var origin = "<?= $barang ?>";
                var destination = $("#kota").val();
                var weight = "<?= $data['total_berat'] ?>";
                var courier = $(this).val();
                // console.log(origin);
                // console.log(destination);
                // console.log(weight);
                // console.log(courier);
                $.ajax({
                    url: '<?= base_url('order/get-courier-services') ?>',
                    method: 'POST',
                    data: {
                        origin: origin,
                        destination: destination,
                        weight: weight,
                        courier: courier
                    },
                    dataType: 'json',
                    success: function(data) {
                        var html = '<option selected>Pilih Layanan Kurir</option>';

                        for (var count = 0; count < data.length; count++) {
                            var cost = data[count].costs;
                            for (var counts = 0; counts < cost.length; counts++) {
                                var value = data[count].costs[counts].cost[0].value;
                                var service = data[count].costs[counts].service
                                // console.log(value);
                                // console.log(service);
                                // console.log(data[count].costs[counts].service);
                                html += '<option value="' + value + '">' + service + '</option>';
                                if (counts < cost.length) {
                                    $('#layanan').html(html);
                                }
                            }
                        }
                    }
                });
            });

            $("#layanan").change(function() {
                var ongkir = parseInt($(this).val());
                var total_harga = parseInt('<?= $data["total_harga"] ?>');

                total_harga = ongkir + total_harga;
                // console.log(total_harga);
                $('#ongkir').html(ongkir);
                $('#harga-final').html(total_harga);
                $('#total_harga').val(total_harga);
            })
        })
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Kuliah\Kuliah\Semester 2\UAS\PWL\uaspwl\app\Views/orders/confirm.blade.php ENDPATH**/ ?>