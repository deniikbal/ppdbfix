<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class payment_xendit extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table = 'xendit_payments';
}
