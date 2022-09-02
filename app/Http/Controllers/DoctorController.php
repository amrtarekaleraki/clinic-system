<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use Illuminate\Http\Request;
use Session;

class DoctorController extends Controller
{

    public function index()
    {
        $doctors = Doctor::all();
        return view('doctors.doctors',compact('doctors'));
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {

        $validateData = $request->validate([

            'doctor_name'=>'required|unique:doctors|max:255',
        ],[

            'doctor_name.required' => "يرجي إدخال اسم الطبيب",
            'doctor_name.unique' => " هذا الاسم موجود مسبقا",
        ]);


            Doctor::create([
                 'doctor_name' => $request->doctor_name,
                 'doctor_note' => $request->doctor_note,
            ]);
            session()->flash('Add','تم الاضافه بنجاح');
            return redirect('/doctors');
    }


    public function show(Doctor $doctor)
    {
        //
    }


    public function edit(Doctor $doctor)
    {
        //
    }

    public function update(Request $request)
    {
        $id = $request->id;

        $this->validate($request, [

            'doctor_name' => 'required|max:255|unique:doctors,doctor_name,'.$id,
        ],[

            'doctor_name.required' =>'يرجي ادخال اسم الطبيب',
            'doctor_name.unique' =>'اسم الطبيب مسجل مسبقا',
        ]);

        $sections = Doctor::find($id);
        $sections->update([
            'doctor_name' => $request->doctor_name,
            'doctor_note' => $request->doctor_note,
        ]);

        session()->flash('edit','تم تعديل الطبيب بنجاج');
        return redirect('/doctors');
    }


    public function destroy(Request $request)
    {
        $id = $request->id;
        Doctor::find($id)->delete();
        session()->flash('delete','تم حذف الطبيب بنجاح');
        return redirect('/doctors');
    }
}
