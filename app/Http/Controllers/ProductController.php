<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Exports\ProductsExport;
use Maatwebsite\Excel\Facades\Excel;
use Rap2hpoutre\FastExcel\FastExcel;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //get products
        $products = Product::query();

        //filter by name
        $products->when($request->name, function ($query) use ($request){
            $querys = $query->where('name','ilike','%'.$request->name.'%');
        });
        
        //filter by category
        if($request->category != 0){
            $products->when($request->category, function ($query) use ($request){
                return $query->where('category_id','=',$request->category);
            });
        }

        //render view with products
        return view('products.index', [
            'categories' => Category::all(),
            'active_category'=> $request->category,
            'products' => $products->paginate(10)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('products.add',[
            'categories' => Category::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:products',
            'category_id' => 'required',
            'buyingprice' => 'required',
            'sellingprice' => 'required',
            'image' => 'image|mimes:jpg,png|max:100',
        ],
        [
            'required' => 'Harap bagian :attribute di isi', 
            'category_id.required' => 'Harap bagian kategori di isi', 
            'unique' => 'Data :attribute sudah terdaftar di sistem!',
            'image.mimes' => 'Format file harus gambar (.jpg atau .png)',
            'image.max' => 'Ukuran file tidak boleh melebihi 100KB',
        ]);

        $product = Product::create([
            'name' => $request->name,
            'category_id' => $request->category_id,
            'buyingprice' => $request->buyingprice,
            'sellingprice' => $request->sellingprice,
            'stock' => $request->stock,
            'image' => $request->file('image')->store('images'),
        ]);

        return redirect('/')->with('status', 'Produk Berhasil Ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        return view('products.edit', [
            'product' => Product::findOrFail($product->id),
            'categories' => Category::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $rules = [
            'category_id' => 'required',
            'buyingprice' => 'required',
            'sellingprice' => 'required',
        ];

        
        if($request->name != $product->name){
            $rules['name'] = 'required|unique:products';
        }

        if($request->image != null){
            $rules['image'] = 'required|image|mimes:jpg,png|max:100';
            $rules['image.required'] ='Harap unggah gambar terlebih dahulu';
            $rules['image.mimes'] ='Format file harus gambar (.jpg atau .png)';
            $rules['image.max'] ='Ukuran file tidak boleh melebihi 100KB';
        }

        $validatedData = $request->validate($rules);

        if($request->image){
            if($request->oldImage){
                Storage::delete($request->oldImage);
            }
            $validatedData['image'] = $request->file('image')->store('images');
        }
        
        Product::where('id', $product->id)->update($validatedData);

        return redirect('/products')->with('status', 'Data berhasil diupdate');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        Product::destroy($product->id);
        Storage::delete($product->image);

        return redirect('/products')->with('status', 'Data berhasil dihapus');
    }


    public function export(Request $request) 
    {
        $products = Product::query();

        //filter by name
        $products->when($request->filter_name, function ($query) use ($request){
            $querys = $query->where('name','ilike','%'.$request->filter_name.'%');
        });
        

        //filter by category
        if($request->filter_category != 0){
            $products->when($request->filter_category, function ($query) use ($request){
                return $query->where('category_id','=',$request->filter_category);
            });
        }

        // dd($products);

        return (new FastExcel(Product::all()))->download('file.xlsx');
    }
}
