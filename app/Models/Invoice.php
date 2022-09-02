<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    // protected $guarded = [];
    protected $fillable = ['disea_id','doctor_id','disease_number','invoice_Date','patient_id','Discount','Status','note'];

    public function patient()
    {
        return $this->belongsTo(Patient::class,'patient_id');
    }

    public function doctor()
    {
        return $this->belongsTo(Doctor::class,'doctor_id');
    }

    public function disease()
    {
        return $this->belongsTo(Disease::class,'disea_id');
    }

}


