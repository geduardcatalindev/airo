<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quotation extends Model
{
    use HasFactory;

    protected $table = 'quotation';

    protected $fillable = [
        'age',
        'currency_id',
        'start_date',
        'end_date',
        'total',
    ];
}
