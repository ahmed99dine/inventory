<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;
use Hashids\Hashids;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
  /**
  * Display a listing of the resource.
  *
  * @return \Illuminate\Http\Response
  */
  public function index()
  {
    $products = Product::latest()->paginate(5);
    //return response($products);
    return view('products.index',compact('products'))
    ->with('i', (request()->input('page', 1) - 1) * 5);
  }

  /**
  * Show the form for creating a new resource.
  *
  * @return \Illuminate\Http\Response
  */
  public function create()
  {
    return view('products.create');
  }

  /**
  * Store a newly created resource in storage.
  *
  * @param  \Illuminate\Http\Request  $request
  * @return \Illuminate\Http\Response
  */
  public function store(Request $request)
  {

    $request->validate([
      'model_no' => 'required',
      'make' => 'required',
      'description' => 'required',
      'year'=>'required'
    ]);

    Product::create($request->all());

    return redirect()->route('products.index')
    ->with('success','Product created successfully.');
  }

  /**
  * Display the specified resource.
  *
  * @param  \App\Product  $product
  * @return \Illuminate\Http\Response
  */
  public function show($id)
  {
    $hashids = new Hashids(Product::class, 10);
    $id = $hashids->decode($id);

    $product = Product::where('id',$id)->first();

    return view('products.show',compact('product'));
  }

  /**
  * Show the form for editing the specified resource.
  *
  * @param  Request  $request
  * @param  string  id
  * @return \Illuminate\Http\Response
  */
  public function edit(Request $request,$id)
  {
    $generator = new Hashids(Product::class, 10);
    $modelId = $generator->decode($id);

    $product = Product::where('id',$modelId)->first();

    return view('products.edit',compact('product'));
  }

  /**
  * Update the specified resource in storage.
  *
  * @param  \Illuminate\Http\Request  $request
  * @param  \App\Product  $product
  * @return \Illuminate\Http\Response
  */
  public function update(Request $request,$id)
  {
    $generator = new Hashids(Product::class, 10);
    $modelId = $generator->decode($id);
    $product = Product::where('id',$modelId)->first();

    $request->validate([
      'model_no' => 'required',
      'make' => 'required',
      'description' => 'required',
      'year'=>'required'

    ]);

    $product->model_no = $request->input('model_no');
    $product->make = $request->input('make');
    $product->description = $request->input('description');
    $product->year = $request->input('year');

    $product->save();

    return redirect()->route('products.index')
    ->with('success','Product updated successfully.');
  }

  /**
  * Remove the specified resource from storage.
  *
  * @param  \App\Product  $product
  * @return \Illuminate\Http\Response
  */
  public function destroy(Request $request,$id)
  {
    $generator = new Hashids(Product::class, 10);
    $modelId = $generator->decode($id);
    $product = Product::where('id',$modelId)->first();
    $product->delete();

    return redirect()->route('products.index')
    ->with('success','Product deleted successfully');
  }


}
