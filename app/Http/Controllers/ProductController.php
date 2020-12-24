<?php

namespace App\Http\Controllers;

use App\Http\Controllers\DAL\CreateDAL;
use App\Http\Controllers\DAL\DeleteDAL;
use App\Http\Controllers\DAL\ReadDAL;
use App\Http\Controllers\DAL\UpdateDAL;
use App\Http\Requests\ProductRequest;
use App\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    //
    protected $user_id;
    protected $create_dal;
    protected $read_dal;
    protected $update_dal;
    protected $delete_dal;

    public function __construct()
    {
        $this->middleware('jwt');
        $this->user_id = auth()->id();
        $this->create_dal = new CreateDAL;
        $this->read_dal = new ReadDAL;
        $this->update_dal = new UpdateDAL;
        $this->delete_dal = new DeleteDAL;
    }

    public function index(Request $request)
    {
        $all_products = $this->read_dal->getProducts();
        if (count($all_products) > 0) {
            return response($all_products, 200);
        } else {
            return response()->json(['message' => 'No products found for this user'], 404);
        }
    }

    public function store(ProductRequest $request)
    {
        $request['user_id'] = $this->user_id;
        $product = $this->create_dal->addProduct($request);
        if (count($product->toArray()) > 0) {
            return response($product, 200);
        } else {
            return response()->json(['message' => 'Product not added'], 400);
        }
    }

    public function show($product_id)
    {
        $getSpecificProduct = $this->read_dal->getUpdatedProducts($product_id, $this->user_id);
        if ($getSpecificProduct != NULL && count($getSpecificProduct->toArray()) > 0) {
            return response($getSpecificProduct, 200);
        } else {
            return response()->json(['message' => 'Product details not found'], 400);
        }
    }

    public function update(ProductRequest $request, $product_id)
    {
        $updateProduct = $this->update_dal->editProduct($request, $product_id, $this->user_id);
        if ($updateProduct != NULL && count($updateProduct->toArray()) > 0) {
            return response($updateProduct, 200);
        } else {
            return response()->json(['message' => 'Delete unsuccessful.Please check your connection.'], 400);
        }
    }

    public function delete($product_id)
    {
        $deleteProduct = $this->delete_dal->deleteProduct($product_id, $this->user_id);
        if ($deleteProduct) {
            return response()->json(['message' => 'Your product has been deleted.'], 200);
        } else {
            return response()->json(['message' => 'Delete unsuccessful.Please check your connection.'], 400);
        }
    }
}
