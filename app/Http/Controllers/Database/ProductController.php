<?php

namespace App\Http\Controllers\Database;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Models\Product;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		return 	view('cms/products/all')
				->with('products', Product::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
		return 	view('cms/products/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
		$this->validate($request, [
			'name' => 'required'
		]);

		$product = new Product;
		$product->name = $request->get('name');
		$product->save();

		return 	redirect()->route('products.index')
			->with('message_success', 'Product '.$product->name.' has been successfully created');
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
     * @param  int  $id_product
     * @return \Illuminate\Http\Response
     */
    public function edit($id_product)
    {
		$product = Product::findOrFail($id_product);

		return 	view('cms/products/edit')
				->with('product', $product);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id_product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id_product)
    {
		$this->validate($request, [
			'name' => 'required'
		]);

		$product = Product::findOrFail($id_product);
		$product->name = $request->get('name');
		$product->save();

		return 	redirect()->route('products.index')
				->with('message_update', 'Product '.$product->name.' has been successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id_product
     * @return \Illuminate\Http\Response
     */
    public function destroy($id_product)
    {
		$product = Product::findOrFail($id_product);
		$product_name = $product->name;
		$product->delete();

		return 	redirect()->route('products.index')
				->with('message_delete', 'Product '.$product_name.' has been successfully deleted');
    }
}
