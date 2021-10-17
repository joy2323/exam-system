<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assessment extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $table = 'assessments';

    public function question() {
        return $this->hasMany(Question::class);
    }

}
