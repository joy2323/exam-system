<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $table = 'questions';

    public function assessment() {
        return $this->belongsTo(Assessment::class);
    }
}
