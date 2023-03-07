<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class question extends Model
{
    use HasFactory;
    protected $table = 'questions';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id',
        'exam_id',
        'name',
        'level'
    ];
    public function exam()
    {
        return $this->belongsTo(exam::class, 'exam_id', 'id');
    }
    public function answer()
    {
        return $this->hasMany(answer::class, 'question_id', 'id');
    }
    public function testQuestion()
    {
        return $this->hasMany(test_question::class, 'question_id', 'id');
    }
}
