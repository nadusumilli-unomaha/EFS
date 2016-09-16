<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Customer;

use App\Stock;

use App\Investment;

use Auth; 

use Session;

class CustomerController extends Controller
{
    public function index()
    {
      if(Auth::check()){
        $customers=Customer::all();
        return view('customers.index',compact('customers'));
      }
      else{
        return redirect('/');
      }
    }

    public function show($id)
    {
      if(Auth::check()){
        $customer = Customer::findOrFail($id);
        return view('customers.show',compact('customer'));
      }
      else{
        return redirect('/');
      }
    }


    public function create()
    {
      if(Auth::check()){
        return view('customers.create');
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
                'name' => 'required|unique:customers,name',
                'address' => 'required',
                'cust_number' => 'required|numeric',
                'city' => 'required',
                'state' => 'required',
                'zip' => 'required|numeric|digits:5',
                'email' => 'required|email|unique:customers,email',
                'home_phone' => 'numeric|digits:10|unique:customers,home_phone',
                'cell_phone' => 'required|numeric|digits:10|unique:customers,cell_phone',
            ]);
       $customer= new Customer($request->all());
       $customer->save();
              return redirect('customers');
    }

    public function edit($id)
    {
      if((Auth::check() && Session::get("login_id") == $id) || Auth::user()->email == 'admin@admin.com'){
        $customer=Customer::find($id);
        return view('customers.edit',compact('customer'));
      }
      else{
        session()->flash('cust_edit_msg', 'You do not have permissions to edit other customers!.');
        return redirect('customers');
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
        $customer= new Customer($request->all());
        $customer=Customer::find($id);
        $customer->update($request->all());
        return redirect('customers');
    }

    public function destroy($id)
    {
        Customer::find($id)->delete();
        return redirect('customers');
    }

    public function stringify($id)
    {
       // $customer=Customer::where('id', $id)->select('customer_id','name','address','city','state','zip','home_phone','cell_phone')->first();
      $customer = Customer::where('cust_number', $id)->select('cust_number','name','address','city','state','zip','home_phone','cell_phone')->first();
      $customer = $customer->toArray();
      return response()->json($customer);
    }
}
