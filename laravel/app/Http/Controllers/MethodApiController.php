<?php

namespace App\Http\Controllers;

use Validator;
use App\Models\Method;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MethodApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $method = Method::all()->toJson(JSON_PRETTY_PRINT);
        return response($method, 200);
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
        $validateData = Validator::make($request->all(), [
            'methodName'    => 'required',
        ]);
        if ($validateData->fails()) {
            return response($validateData->errors(), 400);
        } else {
            $method = new Method();
            $method->methodName = $request->methodName;
            $method->save();
            return response()->json([
                "message" => "method added"], 201);
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
        //
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
    public function update(Request $request, $id)
    {
        if (Method::where('id', $id)->exists()) {
            $validateData = Validator::make($request->all(), [
                'methodName'          => 'required',
            ]);
            if ($validateData->fails()){
                return response($validateData->errors(), 400);
            } else {
                $method = Method::find($id);
                $method->methodName =  $request->methodName;
                $method->save();
                return response()->json([
                    "message" => "method updated"], 201);
            } 
        } else {
            return response()->json([
                "message" => "method not found"], 404);
        }
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
