<?php

namespace App\Http\Controllers\Api;

use Exception;
use App\Models\Products;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ProductsCollection;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try{
            $products = new ProductsCollection(Products::all());
            return response()->json($products, 200);
        }catch(Exception $error){
            return response()->json(["message" => $error], 500);
        }
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
        try{
            $imageName = md5_file($request->file('file')->getRealPath());
            $imageExtension = $request->file('file')->guessExtension();
            $finalImage = $imageName.'.'.$imageExtension;
     
            $saveProduct = Products::create([
                "name" => $request->name,
                "category" => $request->category,
                "description" => $request->description,
                "lite" => $request->lite,
                "medium" => $request->medium,
                "large" => $request->large,
                "image" => $finalImage,
            ]);

            $request->file('file')->move(public_path("product-images"), $finalImage);

            return response()->json("Successfully Created Product!", 200);
        }catch(\Error $error){
            return response()->json(['message' => $error], 500);
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
        //
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
