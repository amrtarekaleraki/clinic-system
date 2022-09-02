<?php

namespace App\Http\Controllers;

use App\Models\Disease;
use Illuminate\Http\Request;
use Session;


class DiseaseController extends Controller
{

    public function index()
    {
        $diseases = Disease::all();
        return view('diseases.diseases',compact('diseases'));
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        $validateData = $request->validate([

            'disease_name'=>'required|unique:diseases|max:255',
        ],[

            'disease_name.required' => "يرجي إدخال اسم المرض",
            'disease_name.unique' => " هذا الاسم موجود مسبقا",
        ]);



            Disease::create([
                 'disease_name' => $request->disease_name,
                 'disease_price' => $request->disease_price,
            ]);
            session()->flash('Add','تم الاضافه بنجاح');
            return redirect('/diseases');
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

            'disease_name' => 'required|max:255|unique:diseases,disease_name,'.$id,
            'disease_price' => 'required',
        ],[

            'disease_name.required' =>'يرجي ادخال اسم المرض',
            'disease_name.unique' =>'اسم المرض مسجل مسبقا',
            'disease_price.required' =>'يرجي ادخال سعر المرض',


        ]);

        $sections = Disease::find($id);
        $sections->update([
            'disease_name' => $request->disease_name,
            'disease_price' => $request->disease_price,
        ]);

        session()->flash('edit','تم تعديل المرض بنجاج');
        return redirect('/diseases');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Disease  $disease
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $id = $request->id;
        Disease::find($id)->delete();
        session()->flash('delete','تم حذف المرض بنجاح');
        return redirect('/diseases');
    }
}
