<?php

namespace App\Http\Controllers\DAL;

use App\Product;
use Illuminate\Support\Facades\Response;

class ReadDAL
{
    public function getProducts()
    {
        $all_products = auth()->user()->products;
        return $all_products;
    }

    public function getUpdatedProducts($product_id, $user_id)
    {
        $product = Product::where([
            ['id', '=', $product_id],
            ['user_id', '=', $user_id],
        ])->first();

        return $product;
    }
}
