<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Orderpartial;
use App\OrderDetail;
use Illuminate\Support\Facades\Auth;
class OrderpartialController extends Controller
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
        $orderpartial = new Orderpartial();

       
        // get product 
        $product = OrderDetail::where(
            [
                "product_id"=>$request->order_product_id,
                "order_id"=>$request->order_id
            ]
        )->get()->first();

          $countProductQtyIssue = Orderpartial::CountProductQty($product);
          
        if($product){

            if( $countProductQtyIssue >= $product->quantity){
                flash(__('All partial order has been issued for.'.($product->product->name)))->error();
                return redirect()->route('partialOrder',['id'=>encrypt($product->order_id)]);
            }

            if( $request->issue_qty > $product->quantity  ){
                flash(__('Issue quantity cannot grater then order quantity.'))->error();
                return redirect()->route('partialOrder',['id'=>encrypt($product->order_id)]);
            }



            $orderpartial->order_id = $product->order_id;
            $orderpartial->product_id = $product->product_id;
            $orderpartial->user_id = 0; 
            $orderpartial->qty = $request->issue_qty;
            $orderpartial->action_by = Auth::id();
            
            if($orderpartial->save()){
                $product->partial_qty = $countProductQtyIssue;
                $product->save();
            }

            flash(__('Item has been issued successfully'))->success();
            return redirect()->route('partialOrder',['id'=>encrypt($product->order_id)]);
        }else{
            flash(__('Item not found in the order'))->error();
            return redirect()->route('partialOrder',['id'=>encrypt($product->order_id)]);
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
