<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use App\Models\Doctor;
use App\Models\Visit;


use Illuminate\Http\Request;

class PatientController extends Controller
{

    public function index()
    {
        $doctors = Doctor::all();
        $patients = Patient::all();
        $visits = Visit::all();

        return view('patients.patients',compact('patients','doctors','visits'));
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        $validateData = $request->validate([

            'patient_name'=>'required|unique:patients|max:255',
            'visit_id'=>'required',
            'doctor_id'=>'required',
            'patient_Date'=>'required',
        ],[

            'patient_name.required' => "يرجي إدخال اسم المريض",
            'patient_name.unique' => " هذا الاسم موجود مسبقا",
            'visit_id.required' => "يرجي إدخال اسم الزياره",
            'doctor_id.required' => "يرجي إدخال اسم الطبيب",
            'patient_Date.required' => "يرجي إدخال التاريخ ",
        ]);

        Patient::create([
                 'patient_name' => $request->patient_name,
                 'patient_number' => $request->patient_number,
                 'patient_address' => $request->patient_address,
                 'visit_id' => $request->visit_id,
                 'doctor_id' => $request->doctor_id,
                 'note' => $request->note,
                 'patient_Date' => $request->patient_Date,
            ]);
            session()->flash('Add','تم الاضافه بنجاح');
            return redirect('/patients');
    }

    public function show(Patient $patient)
    {
        return "amr";
    }


    public function edit($id)
    {
    }


    public function update(Request $request)
    {
        $id = $request->id;

        $this->validate($request, [

            'patient_name' => 'required|max:255|unique:patients,patient_name,'.$id,
            'visit_id'=>'required',
            'doctor_id'=>'required',
            'patient_Date'=>'required',
        ],[

            'patient_name.required' =>'يرجي ادخال اسم المريض',
            'patient_name.unique' =>'اسم المريض مسجل مسبقا',
            'visit_id.required' =>'يرجي ادخال نوع الزياره',
            'doctor_id.required' =>'يرجي ادخال اسم الطبيب',
            'patient_Date.required' =>'يرجي ادخال التاريخ',


        ]);

        $sections = Patient::find($id);
        $sections->update([
            'patient_name' => $request->patient_name,
            'patient_number' => $request->patient_number,
            'patient_address' => $request->patient_address,
            'visit_id' => $request->visit_id,
            'doctor_id' => $request->doctor_id,
            'note' => $request->note,
            'patient_Date' => $request->patient_Date,
        ]);

        session()->flash('edit','تم تعديل المريض بنجاج');
        return redirect('/patients');
    }

    public function destroy(Request $request)
    {
        $id = $request->id;
        Patient::find($id)->delete();
        session()->flash('delete','تم حذف المريض بنجاح');
        return redirect('/patients');
    }
}
