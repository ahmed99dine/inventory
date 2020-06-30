<?php

namespace App\Http\Controllers;

use App\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Hashids\Hashids;

class SupplierController extends Controller
{
  /**
  * Display a listing of the resource.
  *
  * @return \Illuminate\Http\Response
  */
  public function index()
  {
    $suppliers = Supplier::all();

       return response($suppliers);
    //    return view('suppliers.index',compact('suppliers'))
    // ->with('i', (request()->input('page', 1) - 1) * 6);
  }

  public function orders(Request $request,$id)
  {

    $hashids = new Hashids(Supplier::class, 10);
    $id = $hashids->decode($id);
    $supplier_orders = DB::table('suppliers')
                          ->join('orders', 'orders.supplier_id', '=', 'suppliers.id')
                          ->where('suppliers.id', '=', $id)
                          ->select('suppliers.name as supplier_name','suppliers.email as supplier_email','orders.order_date as date')
                          ->get();
    return response()->json($supplier_orders, 200);
  }

  /**
  * Show the form for creating a new resource.
  *
  * @return \Illuminate\Http\Response
  */
  public function create()
  {
    return view('suppliers.create');
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
      'name' => 'required',
      'phone' => 'required|max:15',
      'email' => 'required',
      'location'=>'required',
    ]);
     // return response (Supplier::create($request->all()));

    return redirect()->route('suppliers.index')
    ->with('success','Supplier created successfully.');
  }

  /**
  * Display the specified resource.
  *
  * @param  \App\Supplier  $supplier
  * @return \Illuminate\Http\Response
  */
  public function show($id)
  {
    $hashids = new Hashids(Supplier::class, 10);
    $id = $hashids->decode($id);
    $supplier = Supplier::where('id',$id)->first();

    return view('suppliers.show',compact('supplier'));
    // return response ($supplier);
  }

  /**
  * Show the form for editing the specified resource.
  *
  * @param  \App\Supplier  $supplier
  * @return \Illuminate\Http\Response
  */
  public function edit(Request $request,$id)
  {
    $hashids = new Hashids(Supplier::class, 10);
    $id = $hashids->decode($id);
    $supplier = Supplier::where('id',$id)->first();
    return view('suppliers.edit',compact('supplier'));
    // return response($supplier);
  }

  /**
  * Update the specified resource in storage.
  *
  * @param  \Illuminate\Http\Request  $request
  * @param   string  id
  * @return \Illuminate\Http\Response
  */
  public function update(Request $request, $id)
  {
    $generator = new Hashids(Supplier::class, 10);
    $modelId = $generator->decode($id);
    $supplier = Supplier::where('id',$modelId)->first();

    $supplier ->update($request->all());
    // $request->validate([
    //   'name' => 'required',
    //   'phone' => 'required',
    //   'email' => 'required',
    //   'location'=>'required',
    //
    // ]);
    //
    // $supplier->name = $request->input('name');
    // $supplier->phone = $request->input('phone');
    // $supplier->email = $request->input('email');
    // $supplier->location = $request->input('location');
    //
    // $supplier->save();

    // return redirect()->route('suppliers.index')
    // ->with('success','Supplier updated successfully.');
     return response ($request);

  }

  /**
  * Remove the specified resource from storage.
  *
  * @param  \App\Supplier  $supplier
  * @return \Illuminate\Http\Response
  */
  public function destroy(Request $request,$id)
  {
    $generator = new Hashids(Supplier::class, 10);
    $modelId = $generator->decode($id);
    $supplier = Supplier::where('id',$modelId)->firstOrfail();
    $supplier->delete();
       return redirect()->route('suppliers.index')
       ->with('success','Supplier deleted successfully');
    // return redirect()->route('suppliers.index')
    // ->with(['message'=>'Not Found']);

  }
}
