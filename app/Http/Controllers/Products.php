<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

use App\Http\Requests\ProductsRequest;
use App\Models\Products as ProductsModel;
use App\Http\Resources\Products as ProductsResource;

use function PHPUnit\Framework\isNull;

class Products extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = ProductsModel::all();
        return response()->json([
            'data'=> $products, 
            'message' => 'Load danh sách thành công'
        ], 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductsRequest $request)
    {
        $validated = $request->validated();        
        try{
            $products = ProductsModel::insertGetId([
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

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $products =ProductsModel::find($id);
        if(isNull($products)){
            return response()->json([
                'message' => 'Không tìm thấy sản phẩm',
                'data' => $products
            ], 201);
        }
        return response()->json([
            'data' => $products
        ], 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request ,ProductsModel $products)
    {
        $input = $request->all();
        $validator = Validator::make($input , [
            'tenSanPham' => 'Required',
            'gia' => 'Required',
        ]);
        if($validator->fails()){
            return response()->json([
                'success'=>false,
                'message' => 'Đã xảy ra lỗi dữ liệu',
                'data'=>$validator->errors()
            ], 500);
        }
        $products->tenSanPham = $input['tenSanPham'];
        $products->gia = $input['gia'];
        $products->save();
        return response()->json([
            'success'=>true,
            'message' => 'Update thành công',
            'data'=>new ProductsResource($products)
        ], 500);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProductsModel $products)
    {
        $products->delete();
        return response()->json([
            'success'=>true,
            'message' => 'Xóa thành công',
        ], 500);
    }
}
