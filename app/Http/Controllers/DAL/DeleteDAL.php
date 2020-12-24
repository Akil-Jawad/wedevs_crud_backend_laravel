<?php

namespace App\Http\Controllers\DAL;

use App\Product;
use Illuminate\Support\Facades\Response;
use phpDocumentor\Reflection\PseudoTypes\True_;

class DeleteDAL
{
    public function deleteProduct($product_id, $user_id)
    {
        $product = Product::where([
            ['id', '=', $product_id],
            ['user_id', '=', $user_id],
        ])->first();
        if ($product != null) {
            $product->delete();
        } else {
            return false;
        }
        return true;
    }
}
