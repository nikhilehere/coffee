<?php

namespace App\Http\Controllers;

use Crypt;
use Session;
use DB;
use Auth;
use DataTables;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Orders;
use App\Models\OrderStatus;
use App\Models\Products;
use App\Models\Customers;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;

class OrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (Auth::user()->isCustomer()) {
            if ($request->ajax()) {
                $customer = Customers::where('user_id',Auth::user()->id)->first();
                $orders = Orders::with('OrderProduct','OrderCustomer','OrderStatus')->where('customer_id',$customer->id);
                return Datatables::eloquent($orders)
                        ->addIndexColumn()
                        ->addColumn('product', function (Orders $orders) {
                            return $orders->OrderProduct->product_name;
                        })
                        
                        ->addColumn('status', function (Orders $orders) {
                            return $orders->OrderStatus->status;
                        })
                        ->addColumn('pay_mode', function ($row) {
                            return $row->pay_mode == 0 ? 'COD' : 'Wallet';
                        })
                        ->addColumn('action', function($row){
         
                                $btn = '<div class="btn-group" role="group" aria-label="Basic example">';
                               
                                $btn .= '<button id="view_order_btn" data-id="'.Crypt::encrypt($row->id).'" data-toggle="modal" data-target="#custViewOrderModal" type="button" class="btn btn-brown" title="View"><i class="far fa-file"></i></button>';
                                if($row->order_status == 1){
                                    $btn .= '<a class="btn btn-brown" href="/orders/'.Crypt::encrypt($row->id).'/edit" title="Edit"><i class="fas fa-edit"></i></a>';
                                    $btn .= '<button id="cancel_order_btn" data-id="'.Crypt::encrypt($row->id).'" data-name="'.$row->order_no.'" data-toggle="modal" data-target="#cancelOrderModal" type="button" class="btn btn-brown" title="Cancel Order"><i class="fas fa-undo-alt"></i></button>';
                                }else{
                                    $btn .= '<a style="cursor: not-allowed;" class="btn btn-brown" title="Cancelled Order"><i class="fas fa-edit"></i></a>';
                                    $btn .= '<button style="cursor: not-allowed;" class="btn btn-brown" title="Cancelled Order"><i class="fas fa-undo-alt"></i></button>';
                                }
                                   //    $btn .= '<button id="delete_order_btn" data-id="'.Crypt::encrypt($row->id).'" data-name="'.$row->order_no.'" data-toggle="modal" data-target="#deleteOrderModal" type="button" class="btn btn-dark" title="Delete"><i class="fas fa-trash"></i></button>';
                                   $btn .= '</div>';
                                   
                                return $btn;
                        })
                        ->rawColumns(['action'])
                        ->make(true);
            }
            return view('customers/shop/myOrders');
        }

        if (Auth::user()->isAdmin()) {
            if ($request->ajax()) {
                $orders = Orders::with('OrderProduct','OrderCustomer','OrderStatus');
                // $orders = Orders::with('OrderProduct','OrderCustomer','OrderStatus')->where('customer_id',3);
                return Datatables::eloquent($orders)
                        ->addIndexColumn()
                        ->addColumn('product', function (Orders $orders) {
                            return $orders->OrderProduct->product_name;
                        })
                        ->addColumn('customer', function (Orders $orders) {
                            return $orders->OrderCustomer->name;
                        })
                        ->addColumn('status', function (Orders $orders) {
                            return $orders->OrderStatus->status;
                        })
                        ->addColumn('pay_mode', function ($row) {
                            return $row->pay_mode == 0 ? 'COD' : 'Wallet';
                        })
                        ->addColumn('action', function($row){
         
                               $btn = '<div class="btn-group" role="group" aria-label="Basic example">';
                               $btn .= '<button id="view_order_btn" data-id="'.Crypt::encrypt($row->id).'" data-toggle="modal" data-target="#viewOrderModal" type="button" class="btn btn-dark" title="View"><i class="far fa-file"></i></button>';
                               $btn .= '<a class="btn btn-dark" href="/orders/'.Crypt::encrypt($row->id).'/edit" title="Edit"><i class="fas fa-edit"></i></a>';
                               $btn .= '<button id="delete_order_btn" data-id="'.Crypt::encrypt($row->id).'" data-name="'.$row->order_no.'" data-toggle="modal" data-target="#deleteOrderModal" type="button" class="btn btn-dark" title="Delete"><i class="fas fa-trash"></i></button>';
                               $btn .= '</div>';
        
                                return $btn;
                        })
                        ->rawColumns(['action'])
                        ->make(true);
            }
            return view('admin/order/orders');
            // $orders = Orders::all();
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $products = Products::all();
        $customers = Customers::all();
        $lastOrderID = isset(Orders::orderBy('id', 'desc')->first()->id) ? (str_pad(Orders::orderBy('id', 'desc')->first()->id + 1, 3, "0", STR_PAD_LEFT)) : '001';
        $year = Carbon::now()->format('y');
        $month = Carbon::now()->format('m');
        $newInsertID = 'CS-' . $year . '-' . $month . $lastOrderID;

        return view('admin/order/addOrder', compact("products", "customers","newInsertID"));
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
            'customer' => 'required',
            'product' => 'required',
            'quantity' => 'required',
            'order_no' => 'required',
        ]);

        if ($validator->fails()) {
            return Redirect::back()
                ->withErrors($validator)
                ->withInput();
        } else {
            // return $request;
            $product = Products::find($request->product);
            
            $order = new Orders();
            $order->order_no        = $request->order_no;
            $order->product_id      = $request->product;
            $order->nos             = $request->quantity;
            $order->customer_id     = $request->customer;
            $order->amount          = $product->product_cost*$request->quantity;
            $order->is_paid         = 0;
            $order->is_admin        = 1;
            $order->pay_mode        = 0;
            $order->order_status    = 1;
            if($order->save()){
                Session::flash('message', 'Success!  Order Placed!'); 
                Session::flash('alert-class', 'alert-success'); 
            }else{
                Session::flash('message', 'Server Error.! order failed'); 
                Session::flash('alert-class', 'alert-danger'); 
            }
            return redirect('/orders');
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
        $order = Orders::find(Crypt::decrypt($id));
        $date = Carbon::parse($order->created_at)->isoFormat('MMM Do YYYY, h:mm a');
        $orderDetails = [
            "order_no"      => $order->order_no,
            "product"       => $order->OrderProduct->product_name,
            "Qty"           => $order->nos,
            "customer"      => $order->OrderCustomer->name,
            "address"       => $order->OrderCustomer->address,
            "payMode"       => $order->pay_mode == 1 ? "Wallet" : "COD", 
            "orderStatus"   => $order->OrderStatus->status,
            "orderTime"     => $date,
        ];
        return $orderDetails;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $status = OrderStatus::all();
        $order = Orders::find(Crypt::decrypt($id));
        if (Auth::user()->isAdmin()) {
            $products = Products::all();
            $customers = Customers::all();
            return view('admin/order/editOrder',compact("products", "customers","order","status"));
        }else{
            return view('customers/shop/editOrder',compact("order","status"));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function updates(Request $request)
    {
        if (Auth::user()->isAdmin()) {
            return $this->adminOrderUpdate($request);
        }
        if (Auth::user()->isCustomer()) {
            return $this->customerOrderUpdate($request);
        }
        return redirect('/orders');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function remove(Request $request)
    {
        $order = Orders::find(Crypt::decrypt($request->order_id));
        if ($order->delete()) {
            Session::flash('message', 'Order is Deleted!'); 
            Session::flash('alert-class', 'alert-success'); 
        }else{
            Session::flash('message', 'Server Error.! Delete Order failed'); 
            Session::flash('alert-class', 'alert-danger');
        }
        return redirect('/orders');
    }

    public function shop(){
        $products = Products::all();
        return view('customers/shop/shop', compact("products"));
    }

    public function buyNow($id){
        $product = Products::find($id);
        $lastOrderID = isset(Orders::orderBy('id', 'desc')->first()->id) ? (str_pad(Orders::orderBy('id', 'desc')->first()->id + 1, 3, "0", STR_PAD_LEFT)) : '001';
        $year = Carbon::now()->format('y');
        $month = Carbon::now()->format('m');
        $newInsertID = 'CS-' . $year . '-' . $month . $lastOrderID;

        return view('customers/shop/buyNow', compact("product","newInsertID"));
    }

    public function customerOrder(Request $request){
        // return $request;
        $validator = Validator::make($request->all(), [
            'product_cost' => 'required',
            'product' => 'required',
            'nos' => 'required',
            'pay_mode' => 'required',
            'order_no' => 'required',
        ]);

        if ($validator->fails()) {
            return Redirect::back()
                ->withErrors($validator)
                ->withInput();
        } else {
            // return $request; // wallet purchase to be implemented
            $product = Products::find($request->product);
            $customer = Customers::where('user_id',Auth::user()->id)->first();
            $totalAmout = $product->product_cost*$request->nos;

            $order = new Orders();

            $order->order_no        = $request->order_no;
            $order->product_id      = $request->product;
            $order->nos             = $request->nos;
            $order->customer_id     = $customer->id;
            $order->amount          = $totalAmout;
            $order->is_paid         = 0;
            $order->is_admin        = 0;
            $order->order_status    = 1;
            if($request->pay_mode == 1){
                if($customer->wallet >= $totalAmout){
                    $order->pay_mode    = 1;
                    $customer->wallet   = $customer->wallet - $totalAmout;
                    $customer->save();
                }else{
                    Session::flash('message', 'insufficient amount in wallet'); 
                    Session::flash('alert-class', 'alert-danger'); 
                    return Redirect::back()
                        ->withErrors($validator)
                        ->withInput();
                }
               
            }else{
                $order->pay_mode    = 0;
            }


            if($order->save()){
                Session::flash('message', 'Success!  Order Placed!'); 
                Session::flash('alert-class', 'alert-success'); 
            }else{
                Session::flash('message', 'Server Error.! order failed'); 
                Session::flash('alert-class', 'alert-danger'); 
            }
            return redirect('/shopNow');
        }
    }

    public function adminOrderUpdate($request){
        $validator = Validator::make($request->all(), [
            'customer' => 'required',
            'product' => 'required',
            'quantity' => 'required',
        ]);

        if ($validator->fails()) {
            return Redirect::back()
                ->withErrors($validator)
                ->withInput();
        } else {
            $order = Orders::find(Crypt::decrypt($request->order_id));
            $product = Products::find($request->product);
            $order->product_id      = $request->product;
            $order->nos             = $request->quantity;
            $order->customer_id     = $request->customer;
            $order->amount          = $product->product_cost*$request->quantity;
            $order->order_status    = $request->order_status;
            if($order->save()){
                Session::flash('message', 'Success!  Order Updated!'); 
                Session::flash('alert-class', 'alert-success'); 
            }else{
                Session::flash('message', 'Server Error.! order update failed'); 
                Session::flash('alert-class', 'alert-danger'); 
            }
            return redirect('/orders');
        }
    }

    public function customerOrderUpdate($request){
        $validator = Validator::make($request->all(), [
            'nos' => 'required',
            'pay_mode' => 'required',
        ]); // select input, default values 

        if ($validator->fails()) {
            return Redirect::back()
                ->withErrors($validator)
                ->withInput();
        } else {
            $order = Orders::find(Crypt::decrypt($request->order_id));
            $product = Products::find($order->product_id);
            $order->nos             = $request->nos;
            $order->amount          = $product->product_cost*$request->nos;
            $order->pay_mode        = $request->pay_mode;
            if($order->save()){
                Session::flash('message', 'Success!  Order Updated!'); 
                Session::flash('alert-class', 'alert-success'); 
            }else{
                Session::flash('message', 'Server Error.! order update failed'); 
                Session::flash('alert-class', 'alert-danger'); 
            }
            return redirect('/orders');
        }
    }

    /**
     * Cancel the specified order from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function cancelOrder(Request $request)
    {
        $order = Orders::find(Crypt::decrypt($request->order_id));
        $customer = Customers::where('user_id',Auth::user()->id)->first();

        // check the status if it processed
        if($order->order_status != 1){
            Session::flash('message', 'Cancel Order failed. Order process has been initiated '); 
            Session::flash('alert-class', 'alert-danger');
            return redirect('/orders');
        }

        $order->order_status = 6;
        $customer->wallet = $customer->wallet + $order->amount;
        if ($order->save() && $customer->save()) {
            Session::flash('message', 'Order has been cancelled!'); 
            Session::flash('alert-class', 'alert-success'); 
        }else{
            Session::flash('message', 'Server Error.! Cancel Order failed'); 
            Session::flash('alert-class', 'alert-danger');
        }
        return redirect('/orders');
    }

}
