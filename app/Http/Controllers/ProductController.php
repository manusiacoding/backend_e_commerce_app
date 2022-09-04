<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Product;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response([
            'product' => Product::orderBy('created_at', 'desc')->with('user:id,name,image')->withCount('comments', 'likes')->get()
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
        $attrs = $request->validate([
            'name'          => 'required|string',
            'price'         => 'required|string',
            'stock'         => 'required|string',
            'description'   => 'required|string',
            'type'          => 'required|string',
            // 'image'          => 'required|string'
        ]);

        $product = Product::create([
            'user_id'       => auth()->user()->id,
            'name'          => $attrs['name'],
            'price'         => $attrs['price'],
            'stock'         => $attrs['stock'],
            'description'   => $attrs['description'],
            'type'          => $attrs['type'],
            // 'image'         => $attrs['image']
        ]);

        return response([
            'message' => 'Product created.',
            'product' => $product
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return response([
            'product' => Product::where('id', $id)->withCount('comments', 'likes')->get()
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
    public function update(Request $request, $id)
    {
        $product = Product::find($id);

        if(!$product){
            return response([
                'message' => 'Product not found.'
            ], 403);
        }

        if($product->user_id != auth()->user()->id){
            return response([
                'message' => 'Permission denied.'
            ], 403);
        }

        $attrs = $request->validate([
            'name'          => 'required|string',
            'price'         => 'required|string',
            'stock'         => 'required|string',
            'description'   => 'required|string',
            'type'          => 'required|string',
            // 'image'          => 'required|string'
        ]);

        $product->update([
            'name'          => $attrs['name'],
            'price'         => $attrs['price'],
            'stock'         => $attrs['stock'],
            'description'   => $attrs['description'],
            'type'          => $attrs['type'],
            // 'image'         => $attrs['image']
        ]);

        return response([
            'message' => "Product updated.",
            'product' => $product
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);

        if(!$product){
            return response([
                'message' => 'Product not found.'
            ], 403);
        }

        if($product->user_id != auth()->user()->id){
            return response([
                'message' => 'Permission denied.'
            ], 403);
        }

        $product->comment()->delete();
        $product->like()->delete();
        $product->delete();

        return response([
            'message' => 'Product deleted.'
        ], 200);
    }
}
