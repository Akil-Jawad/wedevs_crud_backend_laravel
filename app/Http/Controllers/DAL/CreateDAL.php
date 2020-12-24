<?php

namespace App\Http\Controllers\DAL;

use Illuminate\Support\Facades\Response;
use App\Product;

class CreateDAL
{
    public function addProduct($request)
    {
        $product = auth()->user()->products()->create($request->all());
        return $product;
    }
}
