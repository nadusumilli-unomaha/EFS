<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Investment;

use App\Customer;

use DB;

use Auth;

use Session;

class InvestmentController extends Controller
{
    public function index()
    {
      if(Auth::check() && Auth::user()->email == 'admin@admin.com'){
        $investments=Investment::all();
        return view('investments.index',compact('investments'));
      }
      else{
        return back();
      }
    }

    public function show($id)
    {
      if(Auth::check()){
        $investment = Investment::findOrFail($id);
        return view('investments.show',compact('investment'));
      }
      else{
        return redirect('/');
      }
    }


    public function create()
    {
      if(Auth::check()){
        $customers = Customer::pluck('name','id');
        return view('investments.create', compact('customers'));
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
          'category' => 'required',
          'description' => '',
          'acquired_value' => 'required|numeric',
          'acquired_date' => 'required',
          'recent_value' => 'required|numeric',
          'recent_date' => 'required',
      ]);
      $investment= new Investment($request->all());
      $investment->save();
      session()->flash('stock_succcess_created', 'Investment has been successfuly created and added to the portfolio.');
      return redirect('customers/'.$investment['customer_id']);
    }

    public function edit($id)
    {
      if(Auth::check()){
        $investment=Investment::find($id);
        if(Session::get("login_id") == $investment['customer_id']){
          return view('investments.edit',compact('investment'));
        }
        else{
          session()->flash('cust_edit_msg', 'You do not have permissions to edit other customers Investments!.');
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
        $investment= new Investment($request->all());
        $investment=Investment::find($id);
        $investment->update($request->all());
        return redirect('investments');
    }

    public function destroy($id)
    {
        Investment::find($id)->delete();
        return redirect('investments');
    }
}
