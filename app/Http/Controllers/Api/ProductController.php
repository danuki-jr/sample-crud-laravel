<?php

namespace App\Http\Controllers\Api;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{

    public function showAll()
    {
        return response()->json(Product::all());
    }

    public function create(Request $request)
    {
        $data = json_decode($request->input('data'), true);
        $newProduct = array(
            'name' => $data['name'],
            'description' => $data['description']
        );

        try {
            $product = Product::create($newProduct);
            return response()->json($product);
        }
        catch (\Illuminate\Database\QueryException $exception) {
            $errorInfo = $exception->errorInfo;
            return response()->json($errorInfo);
        }
    }

    public function update(Request $request)
    {
        $data = json_decode($request->input('data'), true);
        $updatedProduct = array(
            'name' => $data['name'],
            'description' => $data['description']
        );

        try {
            Product::whereId($data['id'])->update($updatedProduct);
            $product = Product::whereId($data['id'])->first();
            return response()->json($product);
        }
        catch (\Illuminate\Database\QueryException $exception) {
            $errorInfo = $exception->errorInfo;
            return response()->json($errorInfo);
        }
    }


    public function delete(Request $request)
    {
        $id = $request->input('id');

        try {
            $product = Product::whereId($id)->delete();
            return response()->json(array(
                'message' => 'OK'
            ));
        }
        catch (\Illuminate\Database\QueryException $exception) {
            $errorInfo = $exception->errorInfo;
            return response()->json($errorInfo);
        }
    }
}
