@extends('layouts.main')

@section('title', 'Cart')

@section('content')
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
                                    @php
                                        $total_berat = 0;
                                        $total_harga = 0;
                                        $total_jumlah = 0;
                                    @endphp
                                    @foreach ($data['cart']->contents() as $cart)
                                        @php
                                            $total_berat = $total_berat + $cart['qty'] * $cart['options']['berat'];
                                            $total_harga = $total_harga + $cart['qty'] * $cart['price'];
                                            $total_jumlah = $total_jumlah + $cart['qty'];
                                        @endphp
                                        <tr>
                                            <th><input type="number" id="{{ $cart['rowid'] }}" min="1"
                                                    name="qty" class="form-control" value="{{ $cart['qty'] }}"></th>
                                            <td>{{ $cart['name'] }}</td>
                                            <td>Rp{{ number_format($cart['price'], 2, ',', '.') }}</td>
                                            <td>{{ $cart['options']['berat'] }}</td>
                                            <td>Rp{{ number_format($cart['qty'] * $cart['price'], 2, ',', '.') }}</td>
                                            <td>
                                                <button onClick="deleteCart('{{ $cart['rowid'] }}')"
                                                    class="btn btn-danger"><i class="fa fa-times fa-1x"></i></button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="row">
                            <div class="col-sm-8">
                                {{-- <p class="ms-3">Add additional notes and payment information</p> --}}

                            </div>
                            <div class="col-sm-4">
                                <table class="table table-striped">
                                    <tr>
                                        <td class="text-muted ms-3"><span class="text-black me-4">SubTotal</span></td>
                                        <td>Rp{{ number_format($total_harga, 2, ',', '.') }}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-muted ms-3"><span class="text-black me-4">Berat Total</span></td>
                                        <td>{{ $total_berat }} gram</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <form action="{{ base_url('order/checkout') }}" method="post">
                                @php echo csrf_field(); @endphp
                                <input type="hidden" name="total_jumlah" value="{{ $total_jumlah }}" style="display:none">
                                <input type="hidden" name="total_harga" value="{{ $total_harga }}" style="display:none">
                                <input type="hidden" name="total_berat" value="{{ $total_berat }}" style="display:none">
                                <div class="d-flex justify-content-end">
                                    <div class="btn-group">
                                        <a href="{{ base_url('/') }}" class="btn btn-primary text-capitalize"><i
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
@endsection

@section('scripts')
    <script>
        function deleteCart(id) {
            // var id = String(id);
            event.preventDefault();
            console.log(id);
            $.ajax({
                method: 'POST',
                url: '<?= base_url('cart/delete') ?>',
                data: {
                    rowid: id
                },
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
@endsection
