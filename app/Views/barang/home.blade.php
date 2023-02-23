@extends('layouts.main')

@section('css')
    <style>
        .card-img-top {
            width: 100%;
            height: 15vw;
            object-fit: cover;
        }
    </style>
@endsection

@section('title', 'Home')

@section('content')
    <div class="container">
        {{-- Search --}}
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

        @if (session()->getFlashdata('msg'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Sukses!</strong> Barang telah berhasil ditambahkan ke keranjang !!!.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        {{-- Carouse; --}}
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
        {{-- Barang List --}}
        <div class="row row-cols-1 row-cols-md-4 g-4">
            @foreach ($data as $dt)
                <div class="col mx-auto">
                    <form action="{{ base_url('cart/add') }}" method="post">
                        @php echo csrf_field() @endphp
                        <input type="hidden" name="id" value="{{ $dt['id'] }}" style="display:none">
                        <input type="hidden" name="price" value="{{ $dt['harga'] }}" style="display:none">
                        <input type="hidden" name="name" value="{{ $dt['nama'] }}" style="display:none">
                        <input type="hidden" name="gambar" value="{{ $dt['gambar'] }}" style="display:none">
                        <input type="hidden" name="berat" value="{{ $dt['berat'] }}" style="display:none">
                        <div class="card h-100">
                            <img src="{{ base_url('images/uploads/' . $dt['gambar']) }}" class="card-img-top"
                                alt="{{ $dt['gambar'] }}" />
                            <div class="card-body mx-auto">
                                <h5 class="card-title mb-3">{{ $dt['nama'] }}</h5>
                                <div class="d-flex justify-content-center">
                                    <span class="badge badge-pill badge-warning mb-3">Rp
                                        {{ number_format($dt['harga'], 2, ',', '.') }}</span>
                                </div>
                            </div>
                            <div class="card-footer">
                                <div class="d-flex justify-content-center">
                                    <div class="btn-group">
                                        <button type="submit" class="btn btn-success"><i
                                                class="fas fa-shopping-cart"></i> Add to
                                            Cart</button>
                                        <a href="{{ base_url('detail/' . $dt['id']) }}" class="btn btn-primary">
                                            Detail</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            @endforeach
        </div>
    </div>
@endsection
