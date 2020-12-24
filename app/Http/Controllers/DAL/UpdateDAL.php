<?php

namespace App\Http\Controllers\DAL;

use App\Product;
use Illuminate\Support\Facades\Response;

class UpdateDAL
{
    public function editProduct($request, $product_id, $user_id)
    {
        $product = Product::where([
            ['id', '=', $product_id],
            ['user_id', '=', $user_id],
        ])->first();
        if ($product != NULL) {
            $product->update(['title' => $request->title, 'description' => $request->description, 'price' => $request->price, 'image' => $request->image]);
        }
        return $product;
    }
}
