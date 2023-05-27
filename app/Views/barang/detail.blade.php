@extends('layouts.main')

@section('css')
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
@endsection

@section('title', 'Detail Barang')

@section('content')
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
                            src="{{ base_url('images/uploads/' . $data['gambar']) }}" alt="{{ $data['gambar'] }}">
                    </div>
                    <div class="col-md-8">
                        <form action="{{ base_url('cart/add') }}" method="post">
                            @php echo csrf_field() @endphp
                            <input type="hidden" name="id" value="{{ $data['id'] }}" style="display:none">
                            <input type="hidden" name="price" value="{{ $data['harga'] }}" style="display:none">
                            <input type="hidden" name="name" value="{{ $data['nama'] }}" style="display:none">
                            <input type="hidden" name="gambar" value="{{ $data['gambar'] }}" style="display:none">
                            <input type="hidden" name="berat" value="{{ $data['berat'] }}" style="display:none">
                            <h5 class="card-title">{{ $data['nama'] }}</h5>
                            <small>Terjual 3rb+</small>
                            <div class="mb-3"></div>
                            <h3 class="card-title mb-3">Rp{{ number_format($data['harga'], 2, ',', '.') }}</h3>
                            <hr>
                            <div class="table-responsive">
                                <table>
                                    <tbody>
                                        <tr>
                                            <td>Lokasi</td>
                                            <td class="colon"> : </td>
                                            <td>{{ $kota }}</td>
                                        </tr>
                                        <tr>
                                            <td>Berat</td>
                                            <td class="colon"> : </td>
                                            <td>{{ $data['berat'] }} (gram)</td>
                                        </tr>
                                        <tr>
                                            <td>Stok Barang</td>
                                            <td class="colon"> : </td>
                                            <td>{{ $data['jumlah'] }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="mb-3"></div>
                            <p>{{ $data['deskripsi'] }}</p>
                            <div class="d-flex justify-content-end">
                                <button type="submit" class="btn btn-success"><i class="fas fa-shopping-cart"></i> Add to
                                    Cart</button>
                                <a href="{{ base_url('/') }}" class="btn btn-primary"><i class="fas fa-arrow-left"></i>
                                    Back</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
