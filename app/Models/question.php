<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
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
        return $this->belongsTo(Exam::class, 'exam_id', 'id');
    }
    public function answer()
    {
        return $this->hasMany(Answer::class, 'question_id', 'id');
    }
    public function testQuestion()
    {
        return $this->hasMany(TestQuestion::class, 'question_id', 'id');
    }
}
