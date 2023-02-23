@extends('layouts/main')

@section('title', 'Daftar Order')

@section('content')
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
                        @php $no = 1; @endphp
                        @foreach($data as $dt)
                        <tr>
                            <td>{{ $no }}</td>
                            <td>{{ $dt['tgl_pesan'] }}</td>
                            <td>{{ $dt['total_jumlah'] }}</td>
                            <td>Rp{{ number_format($dt['total_harga'], 2, ',', '.') }}</td>
                            <td>{{ $dt['status'] }}</td>
                            <td>
                                <a href="{{ base_url('order/confirm-checkout/'. $dt['id']) }}" class="btn btn-primary">Detail Order</a>
                            </td>
                        </tr>
                        @php $no++; @endphp
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    $(document).ready(function () {
        $('#order-table').dataTable();
    });
</script>
@endsection