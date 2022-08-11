<?php

namespace App\Http\Controllers;

use App\Http\Resources\Type as TypeResource;
use App\Models\TypeModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use function PHPUnit\Framework\isNull;

class TypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {    
        $products = TypeModel::all();
        return response()->json([
            'message' => 'Load danh sách thành công',
            'data'=> $products, 
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
    public function store(Request $request)
    {
        $validated = $request->validated();        
        try{
            $products = TypeModel::insertGetId([
                'tenSanPham' => $validated['tenSanPham']             
            ]);
            return response()->json([
                'message' => 'Thêm thành công',
                'data'=> $products, 
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
        $products =TypeModel::find($id);
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
    public function update(Request $request ,TypeModel $Type)
    {
        $input = $request->all();
        $validator = Validator::make($input , [
            'tenLoai' => 'Required'
        ]);
        if($validator->fails()){
            return response()->json([
                'success'=>false,
                'message' => 'Đã xảy ra lỗi dữ liệu',
                'data'=>$validator->errors()
            ], 500);
        }
        $Type->tenSanPham = $input['tenSanPham'];
        $Type->gia = $input['gia'];
        $Type->save();
        return response()->json([
            'success'=>true,
            'message' => 'Update thành công',
            'data'=>new TypeResource($Type)
        ], 500);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
