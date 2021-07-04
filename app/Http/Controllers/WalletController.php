<?php

namespace App\Http\Controllers;

use Auth;
use Session;
use Illuminate\Http\Request;
use App\Models\Customers;
use App\Models\User;
use Illuminate\Support\Facades\Redirect;

class WalletController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        //
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

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function myWallet()
    {
        $customer = Customers::where('user_id',Auth::user()->id)->first();
        return view('customers/wallet/myWallet',compact("customer"));
    }
    public function wRecharge()
    {
        $customer = Customers::where('user_id',Auth::user()->id)->first();
        return view('customers/wallet/recharge',compact("customer"));
    }
    public function recharge(Request $request)
    {
        $customer = Customers::where('user_id',Auth::user()->id)->first();
        $customer->wallet = $customer->wallet+$request->amount;
        $customer->save();
        return redirect('/wallet');
        // return $request;
    }
    
    public function withdrawalForm()
    {
        $customer = Customers::where('user_id',Auth::user()->id)->first();
        return view('customers/wallet/withdrawal',compact("customer"));
    }

    public function withdrawal(Request $request)
    {
        $customer = Customers::where('user_id',Auth::user()->id)->first();
        if($customer->wallet >= $request->amount){
            $customer->wallet = $customer->wallet-$request->amount;
            $customer->save();
            Session::flash('message', 'Success!  Withdrawal of '.$request->amount.' is succeess!'); 
            Session::flash('alert-class', 'alert-success'); 
            return redirect('/wallet');
        }else{
            Session::flash('message', 'Failed! Insufficient Wallet amount'); 
            Session::flash('alert-class', 'alert-danger');
            return Redirect::back()
                ->withInput(); 
        }
        // return $request;
    }
}
