<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Field extends Model
{
    protected $fillable = [
        'form_id',
        'label',
        'type',
        'required',
        'validation',
        'order',
        'options'
    ];

    protected $casts = [
        'options' => 'array',
    ];

    public function form()
    {
        return $this->belongsTo(Form::class);
    }
}