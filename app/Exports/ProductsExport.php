<?php

namespace App\Exports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\FromCollection;

class ProductsExport implements FromCollection
{
    public function view(): View
    {
        return view('products.index', [
            'products' => Products::all()
        ]);
    }
}