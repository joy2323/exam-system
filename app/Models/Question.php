<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    // protected $guarded = ['id'];
    protected $fillable = [
        'question',
        'question_category',
        'options',
    ];

    protected $table = 'questions';

    //fetch text values and set them as arrays
    protected $casts = [
        'options' => 'array'
    ];

    public function assessment() {
        return $this->belongsTo(Assessment::class);
    }
}
