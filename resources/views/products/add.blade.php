@extends('template.app')
 
@section('content')
<div class="container-fluid px-4">

    <h3 class="mt-4 ">Tambah Produk</h3>
  
    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif
    @if($errors->any())
        <div class="alert alert-danger">
            {{$errors->first()}}
        </div>
    @endif

    <div class="row">
        <div class="col-md-9">

            <form action="/products" method="post" enctype="multipart/form-data">
                @csrf
                @method('post')
                <div class="row">
                    <div class="col-md-3">
                        <label for="category" class="form-label">Kategori Produk</label>
                        <select class="form-select" name="category_id" id="category">
                            <option value="" disabled selected>Pilih kategori</option>
                            @foreach ($categories as $category)
                                <option value="{{$category->id}}">{{$category->name}}</option>
                            @endforeach
                        </select>
                        @error('category')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-9">
                        <label for="name" class="form-label">Nama Barang</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="Masukkan nama barang" required autofocus value="{{old('name')}}">
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col">
                        <label for="buyingprice" class="form-label">Harga Beli</label>
                        <input type="number" class="form-control @error('buyingprice') is-invalid @enderror" id="buyingprice" name="buyingprice" required autofocus value="{{old('buyingprice')}}" onchange="setSellingprice()">
                        @error('buyingprice')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col">
                        <label for="sellingprice" class="form-label">Harga Jual*</label>
                        <input type="number" class="form-control @error('sellingprice') is-invalid @enderror" id="sellingprice" name="sellingprice" required autofocus value="{{old('sellingprice')}}">
                        @error('sellingprice')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col">
                        <label for="stock" class="form-label">Stok Barang</label>
                        <input type="number" class="form-control @error('stock') is-invalid @enderror" id="stock" name="stock"  placeholder="Masukkan jumlah stok barang" required autofocus value="{{old('stock')}}">
                        @error('stock')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="row mt-4 mb-2">
                    <div class="container">
                        <label for="image" class="form-label">Upload Image</label>
                        <div class="upload-box">
                            <div class="upload-placeholder" id="uploadPlaceholder">
                                <div class="icon">
                                    <i class="bi bi-image"></i>
                                </div>
                                <p>upload gambar disini</p>
                            </div>
                            <img id="previewImg" alt="Uploaded Image">
                            <input type="file" class="form-control d-none" id="image" name="image" accept="image/*">
                        </div>
                    </div>
                </div>
                <div class="flex flex-row-reverse">
                    <div class="ps-3">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                    <div>
                        <a href="/" class="btn btn-outline-primary">Batalkan</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
