<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Stock;

use App\Customer;

use DB;

use Auth;

use Session;

class StockController extends Controller
{
    public function index()
    {
      if(Auth::check() && Auth::user()->email == 'admin@admin.com'){
        $stocks=Stock::all();
        return view('stocks.index',compact('stocks'));
      }
      else{
        return back();
      }
    }

    public function show($id)
    {
      if(Auth::check()){
        $stock = Stock::findOrFail($id);
        return view('stocks.show',compact('stock'));
      }
      else{
        return redirect('/');
      }
    }


    public function create()
    {
      if(Auth::check()){
        $customers = Customer::pluck('name','id');
        return view('stocks.create', compact('customers'));
      }
      else{
        return redirect('/');
      }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)   
    {
      $this->validate($request,[
        'symbol' => 'required',
        'name' => 'required',
        'shares' => 'required|numeric',
        'purchase_price' => 'required|numeric',
        'purchased' => 'required'
      ]);
      $stock= new Stock($request->all());
      $stock->save();
      
      session()->flash('stock_succcess_created', 'Stock has been successfuly created and added to the portfolio.');
      return redirect('customers/'.$stock['customer_id']);
    }

    public function edit($id)
    {
      if(Auth::check())
      {
          $stock=Stock::find($id);
          if(Session::get("login_id") == $stock['customer_id'] || Auth::user()->email == 'admin@admin.com'){
            return view('stocks.edit',compact('stock'));
          }
          else{
            session()->flash('cust_edit_msg', 'You do not have permissions to edit other customers Stocks!.');
            return redirect('customers');
          }
      }
      else{
        return redirect('/');
      }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id,Request $request)
    {
        //
        $stock= new Stock($request->all());
        $stock=Stock::find($id);
        $stock->update($request->all());
        return redirect('customers/'.$stock->customer_id);
    }

    public function destroy($id)
    {
        $stock=Stock::find($id);
        $cust = $stock->customer_id;
        Stock::find($id)->delete();
        return redirect('customers/'.$cust);
    }
}
