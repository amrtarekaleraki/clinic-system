<?php

namespace App\Http\Controllers;


use App\Models\Doctor;
use App\Models\Disease;
use App\Models\Patient;
use App\Models\Invoice;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{

    public function index()
    {
        $patients = Patient::all();
        $doctors =  Doctor::all();
        $diseases = Disease::all();
        $invoices = Invoice::all();
        // $invoices = Invoice::with('patient','doctor','disease')->get();

        return view('invoices.invoices',compact('invoices','doctors','diseases','patients'));
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {

        $validateData = $request->validate([

            'patient_id'=>'required',
            'disea_id'=>'required',
            'disease_number'=>'required',
            'doctor_id'=>'required',
            'Status'=>'required',
            'invoice_Date'=>'required',
        ],[

            'patient_id.required' => "يرجي إدخال اسم المريض",
            'patient_id.unique' => " هذا الاسم موجود مسبقا",
            'disease_number.required' => "يرجي إدخال العدد ",
            'visit_status.required' => "يرجي إدخال نوع الزياره",
            'doctor_id.required' => "يرجي إدخال اسم الطبيب",
            'Status.required' => "يرجي إدخال الحاله",
        ]);

        Invoice::create([
                 'patient_id' => $request->patient_id,
                 'disea_id' => $request->disea_id,
                 'disease_number' => $request->disease_number,
                 'Discount' => $request->Discount,
                 'doctor_id' => $request->doctor_id,
                 'Status' => $request->Status,
                 'invoice_Date' => $request->invoice_Date,
                 'note' => $request->note,
            ]);
            session()->flash('Add','تم الاضافه بنجاح');
            return redirect('/invoices');
    }


    public function show(Invoices $invoices)
    {
        //
    }


    public function edit(Invoices $invoices)
    {
        //
    }

    public function update(Request $request)
    {

        $this->validate($request, [

            'patient_name' => 'required',
            'disease_name'=>'required',
            'doctor_name'=>'required',
            'Status'=>'required',
            'invoice_Date'=>'required',
        ],[

            'patient_name.required' =>'يرجي ادخال اسم المريض',
            'disease_name.required' =>'يرجي ادخال نوع المرض',
            'doctor_name.required' =>'يرجي ادخال اسم الطبيب',
            'Status.required' =>'يرجي ادخال الحاله',
            'invoice_Date.required' =>'يرجي ادخال التاريخ',


        ]);

        $sections = Invoice::find($id);
        $sections->update([
            'disea_id' => $request->disea_id,
            'doctor_id' => $request->doctor_id,
            'disease_number' => $request->disease_number,
            'invoice_Date' => $request->invoice_Date,
            'patient_id' => $request->patient_id,
            'Discount' => $request->Discount,
            'Status' => $request->Status,
            'note' => $request->note,
        ]);

        session()->flash('edit','تم تعديل الفاتوره بنجاج');
        return redirect('/invoices');
    }


    public function destroy(Invoices $invoices)
    {
        $id = $request->id;
        Invoice::find($id)->delete();
        session()->flash('delete','تم حذف الفاتوره بنجاح');
        return redirect('/invoices');
    }


    public function Print_invoice($id)
    {
        $invoice = Invoice::where('id', $id)->first();
        return view('invoices.Print_invoice',compact('invoice'));
    }

}












