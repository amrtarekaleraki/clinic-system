<?php

namespace App\Http\Controllers;

use App\Models\Cash;
use Illuminate\Http\Request;
use Session;


class CashController extends Controller
{

    public function index()
    {
        $cashes = Cash::all();
        return view('cash.cash',compact('cashes'));
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        $validateData = $request->validate([

            'cash_name'=>'required',
        ],[

            'cash_name.required' => "يرجي إدخال اسم البند",
        ]);



        Cash::create([
                 'cash_name' => $request->cash_name,
                 'cash_price' => $request->cash_price,
                 'cash_time' => $request->cash_time,
            ]);
            session()->flash('Add','تم الاضافه بنجاح');
            return redirect('/cash');
    }


    public function show(Disease $disease)
    {
        //
    }

    public function edit(Disease $disease)
    {
        //
    }


    public function update(Request $request)
    {
        $id = $request->id;

        $this->validate($request, [

            'cash_name' => 'required',
            'cash_price' => 'required',
            'cash_time' => 'required',
        ],[

            'cash_name.required' =>'يرجي ادخال اسم البند',
            'cash_price.required' =>'يرجي ادخال سعر البند',
            'cash_time.required' =>'يرجي ادخال تاريخ البند',


        ]);

        $sections = Cash::find($id);
        $sections->update([
            'cash_name' => $request->cash_name,
            'cash_price' => $request->cash_price,
            'cash_time' => $request->cash_time,
        ]);

        session()->flash('edit','تم تعديل البند بنجاج');
        return redirect('/cash');
    }


    public function destroy(Request $request)
    {
        $id = $request->id;
        Cash::find($id)->delete();
        session()->flash('delete','تم حذف البند بنجاح');
        return redirect('/cash');
    }
}
