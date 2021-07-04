<?php

namespace App\Http\Controllers;

use Crypt;
use Session;
use DB;
use Hash;
use Auth;
use Illuminate\Http\Request;
use App\Models\Customers;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;

class CustomersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customers = Customers::all();
        return view('admin/customer/customers')->with('customers', $customers);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin/customer/addCustomer');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {

            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'age' => 'required',
                'email' => 'required',
                'mobile' => 'required',
            ]);

            if ($validator->fails()) {
                return Redirect::back()
                    ->withErrors($validator)
                    ->withInput();
            } else {
                if(count(User::where('email',$request->email)->get()) != 0){
                    Session::flash('message', 'This email id is already registered!'); 
                    Session::flash('alert-class', 'alert-danger'); 
                    return Redirect::back()
                    ->withErrors($validator)
                    ->withInput();
                }

                $user = new User();
                $user->name         = $request->name;
                $user->email        = $request->email;
                $user->role_id      = 2;
                $user->password     = Hash::make('password');
                if($user->save()){
                    $customer = new Customers();
                    $customer->user_id  = $user->id;
                    $customer->name     = $request->name;
                    $customer->mobile   = $request->mobile;
                    $customer->email    = $request->email;
                    $customer->address  = $request->address;
                    $customer->wallet   = 0;
                    $customer->age      = $request->age;
                    $customer->gender   = $request->gender;
                    if($customer->save()){
                        Session::flash('message', 'A new Customer is created!'); 
                        Session::flash('alert-class', 'alert-success'); 
                    }else{
                        Session::flash('message', 'Server Error.! creating customer failed'); 
                        Session::flash('alert-class', 'alert-danger'); 
                    }
                }else{
                    Session::flash('message', 'Server Error.! creating customer failed'); 
                    Session::flash('alert-class', 'alert-danger'); 
                }
                if (Auth::check() && Auth::user()->isAdmin()) {
                    return redirect('/customers');
                }
                return redirect('/');
            }   
        }catch(Exception $e){
            Session::flash('message', 'Server Error.! creating customer failed'); 
            Session::flash('alert-class', 'alert-danger');
            return redirect('/customers');
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
        if (Auth::user()->isCustomer()) {
            $customer = Customers::where('user_id',Auth::user()->id)->first();
            return view('customers/profile/myProfile')->with('customer', $customer);
        }else{
            $customer = Customers::find(Crypt::decrypt($id));
            return $customer;
        }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $customer = Customers::find(Crypt::decrypt($id));
        return view('admin/customer/editCustomer')->with('customer', $customer);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updates(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'age' => 'required',
            'email' => 'required',
            'mobile' => 'required',
        ]);

        if ($validator->fails()) {
            return Redirect::back()
                ->withErrors($validator)
                ->withInput();
        } else {
            if (Auth::user()->isCustomer()) {
                $customer = Customers::where('user_id',Auth::user()->id)->first();
            }else{
                $customer = Customers::find(Crypt::decrypt($request->customer_id));
            }

            $user = Auth::user();

            if(count(User::where('email',$request->email)->get()) != 0 && $user->email != $request->email){
                Session::flash('message', 'This email id is already registered!'); 
                Session::flash('alert-class', 'alert-danger'); 
                return Redirect::back()
                ->withErrors($validator)
                ->withInput();
            }

            $user->name         = $request->name;
            $user->email        = $request->email;
            // $user->password     = Hash::make('password');  //resetting to 'password'
            if($user->save()){
                $customer->name     = $request->name;
                $customer->mobile   = $request->mobile;
                $customer->email    = $request->email;
                $customer->address  = $request->address;
                $customer->age      = $request->age;
                $customer->gender   = $request->gender;
                if($customer->save()){
                    Session::flash('message', 'Customer profile Updated!'); 
                    Session::flash('alert-class', 'alert-success'); 
                }else{
                    Session::flash('message', 'Server Error.! customer profile update failed'); 
                    Session::flash('alert-class', 'alert-danger'); 
                }
            }else{
                Session::flash('message', 'Server Error.! customer data update failed'); 
                Session::flash('alert-class', 'alert-danger'); 
            }
            if (Auth::user()->isCustomer()) {
                return redirect('/shopNow');
            }
            return redirect('/customers');
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
        $customer = Customers::find(Crypt::decrypt($request->customer_id));
        $user = User::find($customer->user_id);
        if ($customer->delete() && $user->delete()) {
            Session::flash('message', 'Customer is Deleted!'); 
            Session::flash('alert-class', 'alert-success'); 
        }else{
            Session::flash('message', 'Server Error.! Delete Customer failed'); 
            Session::flash('alert-class', 'alert-danger');
        }
        return redirect('/customers');
    }

    public function registerForm()
    {
        return view('customers/profile/createProfile');
    }

    public function register(Request $request)
    {
        
    }
}
