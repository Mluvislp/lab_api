<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductsRequest;
use App\Models\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ProductController extends Controller
{
    public function create(ProductsRequest $request){
        $validated = $request->validated();        
        try{
            $products = Products::insertGetId([
                'tenSanPham' => $validated['tenSanPham'],
                'gia' => $validated['gia'],
                'anHien' => $validated['anHien'],
            ]);
            return response()->json([
                'data'=> $products, 
                'message' => 'Thêm thành công'
            ], 201);
        }catch(\Exception $e){
            Log::error($e);
            return response()->json([
                'message' => 'Đã xảy ra lỗi'
            ], 500);
        }
    }
    public function update(ProductsRequest $request){
             
        try{
            $validated = $request->validated();  
            $products = Products::where('id', $validated['id'])
            ->update([
                'tenSanPham' => $validated['tenSanPham'],
                'gia' => $validated['gia'],
                'anHien' => $validated['anHien'],
        ]);
            return response()->json([
                'data'=> $products, 
                'message' => 'Thêm thành công'
            ], 201);
        }catch(\Exception $e){
            Log::error($e);
            return response()->json([
                'message' => 'Đã xảy ra lỗi'
            ], 500);
        }
    }
   
}
