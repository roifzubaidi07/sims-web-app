
@extends('template.app')

@section('content')
<div class="container-fluid px-4">
    <h3 class="mt-4">Daftar Produk</h3>
    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif
    @error('sertifikat')
        <div class="alert alert-danger">
            {{ $message }}
        </div>
    @enderror

        <form>
            <div class="row mb-2">
                <div class="form-group col-md-2">
                    <input type="text" class="form-control" name="name" id="name" placeholder="Cari barang" value="{{ isset($_GET['name']) ? $_GET['name'] : '' }}">
                </div>
                <div class="form-group col-md-3 d-inline">
                    <select id="category" name="category" class="form-control">
                        <option value="0" selected>Semua kategori</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" @if ($active_category == $category->id) selected @endif >{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col">
                    <button type="submit" class="btn btn-primary">Filter</button>
                </div>
                <div class="col w-full">
                    <div class="flex flex-row-reverse">
                        <div>
                            <div class="float-right mb-2 ps-3"><a href="/products/create" class="btn btn-danger">Tambah Produk</a></div>
                        </div>
                        <div>
                        </form>
                            {{-- <form action="/products/export" method="POST" target="_blank">
                                @csrf
                                @method('post') --}}
                                <a href="{{ route('products.export') }}" class="btn btn-success btn-md">Export Excel</a>
                                {{-- <button type="submit" class="btn btn-success">Export Excel</button> --}}
                            {{-- </form> --}}
                        </div>
                    </div>
                </div>
            </div>

    <div class="card mb-4">
        <div class="card-body">
            <table id="example" class="table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Image</th>
                        <th>Nama Produk</th>
                        <th>Kategori Produk</th>
                        <th>Harga Beli (Rp)</th>
                        <th>Harga Jual (Rp)</th>
                        <th>Stok</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($products as $key => $product)
                      <tr>
                          <td>{{ $key + 1 }}</td>
                          <td class="text-center">
                              @php $path = Storage::url($product->image); @endphp
                              <img src="{{ url($path) }}" alt="" class="" style="width: 25px">
                          </td>
                          <td>{{ $product->name }}</td>
                          <td>{{ $product->category?->name }}</td>
                          <td>{!! $product->buyingprice !!}</td>
                          <td>{!! $product->sellingprice !!}</td>
                          <td>{!! $product->stock !!}</td>
                          <td class="text-center">
                              <div class="flex flex-row">
                                  <div>
                                      <a href="{{ route('products.edit', $product->id) }}" class=""><img src="{{ asset('assets/edit.png') }}" alt=""></a>
                                    </div>
                                    <div  class="ps-4">
                                        <form action="/products/{{$product->id}}" method="post" class="d-inline">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="" onclick="return confirm(`Apakah Anda yakin ingin menghapus {{$product->name}} dari database ?`)"><img src="{{ asset('assets/delete.png') }}" alt=""></button>
                                        </form>
                                    </div>
                                </div>

                          </td>
                      </tr>
                    @empty
                        <div class="alert alert-danger">
                            Data product belum Tersedia.
                        </div>
                    @endforelse
                  </tbody>
                </table>
            {{ $products->links() }}
        </div>
    </div>
</div>
@endsection

@push('scripts')
    <script>
        function filterCategory(){
            var categories = $('#category_filter').val();
            console.log(categories);
        }
    </script>
@endpush