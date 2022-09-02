<?php

namespace App\Http\Controllers;

use App\Models\Visit;
use Illuminate\Http\Request;

class VisitController extends Controller
{

    public function index()
    {
        $visits = Visit::all();
        return view('visits.visits',compact('visits'));
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        $validateData = $request->validate([

            'visit_name'=>'required|unique:visits|max:255',
            'visit_price'=>'required',
        ],[

            'disease_name.required' => "يرجي إدخال اسم الطبيب",
            'disease_name.unique' => " هذا الاسم موجود مسبقا",
            'visit_price.required' => "يرجي إدخال سعر الزياره",
        ]);



            Visit::create([
                 'visit_name' => $request->visit_name,
                 'visit_price' => $request->visit_price,
            ]);
            session()->flash('Add','تم الاضافه بنجاح');
            return redirect('/visits');
    }


    public function show(Visit $visit)
    {
        //
    }


    public function edit(Visit $visit)
    {
        //
    }


    public function update(Request $request)
    {
        $id = $request->id;

        $this->validate($request, [

            'visit_name' => 'required|max:255|unique:visits,visit_name,'.$id,
            'visit_price' => 'required',
        ],[

            'visit_name.required' =>'يرجي ادخال اسم الزياره',
            'visit_name.unique' =>'اسم الزياره مسجل مسبقا',
            'visit_price.required' =>'يرجي ادخال سعر الزياره',


        ]);

        $sections = Visit::find($id);
        $sections->update([
            'visit_name' => $request->visit_name,
            'visit_price' => $request->visit_price,
        ]);

        session()->flash('edit','تم تعديل الزياره بنجاج');
        return redirect('/visits');
    }


    public function destroy(Request $request)
    {
        $id = $request->id;
        Visit::find($id)->delete();
        session()->flash('delete','تم حذف الزياره بنجاح');
        return redirect('/visits');
    }
}
