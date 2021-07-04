<?php

namespace App\Http\Controllers;

use Crypt;
use Session;
use Illuminate\Http\Request;
use App\Models\Products;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $products = Products::all();
        return view('admin/product/products')->with('products', $products);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin/product/addProduct');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'product_name' => 'required',
            'product_cost' => 'required',
            'product_quantity' => 'required',
        ]);

        if ($validator->fails()) {
            return Redirect::back()
                ->withErrors($validator)
                ->withInput();
        } else {
            $product = new Products();
            $product->product_name  = $request->product_name;
            $product->product_no    = $request->product_no;
            $product->product_cost  = $request->product_cost;
            $product->quantity      = $request->product_quantity;
            $product->active        = $request->product_availability;
            if($product->save()){
                Session::flash('message', 'A new product is added!'); 
                Session::flash('alert-class', 'alert-success'); 
            }else{
                Session::flash('message', 'Server Error.! Product is not added'); 
                Session::flash('alert-class', 'alert-danger'); 
            }
            return redirect('/products');
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
        return Products::find(Crypt::decrypt($id));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Products::find(Crypt::decrypt($id));
        return view('admin/product/editProduct')->with('product', $product);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function updates(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'product_name' => 'required',
            'product_cost' => 'required',
            'product_quantity' => 'required',
        ]);

        if ($validator->fails()) {
            return Redirect::back()
                ->withErrors($validator)
                ->withInput();
        } else {
            $product = Products::find(Crypt::decrypt($request->product_id));
            $product->product_name  = $request->product_name;
            $product->product_no    = $request->product_no;
            $product->product_cost  = $request->product_cost;
            $product->quantity      = $request->product_quantity;
            $product->active        = $request->product_availability;
            if($product->save()){
                Session::flash('message', 'A new product is Updated!'); 
                Session::flash('alert-class', 'alert-success'); 
            }else{
                Session::flash('message', 'Server Error.! Product is not updated'); 
                Session::flash('alert-class', 'alert-danger'); 
            }
            return redirect('/products');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $product = Products::find(Crypt::decrypt($request->product_id));
        if ($product->delete()) {
            Session::flash('message', 'Product is Deleted!'); 
            Session::flash('alert-class', 'alert-success'); 
        }else{
            Session::flash('message', 'Server Error.! Product is not delete'); 
            Session::flash('alert-class', 'alert-danger');
        }
        return redirect('/products');
    }
}
