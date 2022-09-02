<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Cash extends Model
{
    use HasFactory;

    protected $fillable = ['cash_name','cash_price','cash_time'];

}
