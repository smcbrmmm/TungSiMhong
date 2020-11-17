<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all();

        return view('product.index', ['products' => $products]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('product.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $img = $request->file('img');
        $input = time().'.'.$img->getClientOriginalExtension();
        $des = public_path('storage/imgProduct/');
        $img->move($des,$input);

        $product = new Product();
        $product->product_name = $request->input('product_name');
        $product->product_code = $request->input('product_code');
        $product->product_price = $request->input('product_price');
        $product->product_quantity =  $request->input('product_quantity');
        $product->product_weight = $request->input('product_weight');
        $product->product_detail = $request->input('product_detail');
        $product->img = '/imgProduct/'.$input;;
        $product->save();

        return redirect()->route('product.index');
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
        $product = Product::findOrFail($id);
        return view('product.edit', [
            'product' => $product
        ]);
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
        if($request->file('img')!=null) {
            $img = $request->file('img');
            $input = time() . '.' . $img->getClientOriginalExtension();
            $des = public_path('storage/imgProduct/');
            $img->move($des, $input);
        }

        $product = Product::findOrFail($id);
        $product->product_name = $request->input('product_name');
        $product->product_code = $request->input('product_code');
        $product->product_price = $request->input('product_price');
        $product->product_quantity =  $request->input('product_quantity');
        $product->product_weight = $request->input('product_weight');
        $product->product_detail = $request->input('product_detail');
        if ($request->file('img')!=null){
            $product->img = '/imgProduct/'.$input;;
        }
        $product->save();

        return redirect()->route('product.index');
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
