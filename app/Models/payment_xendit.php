<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class payment_xendit extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $table = 'xendit_payments';

    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class);
    }
}
