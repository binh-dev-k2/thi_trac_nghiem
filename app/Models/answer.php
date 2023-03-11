<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    use HasFactory;
    protected $table = 'answers';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id',
        'question_id',
        'content',
        'status'
    ];
    public function question()
    {
        return $this->belongsTo(Question::class, 'question_id', 'id');
    }
    public function answerStudentTest()
    {
        return $this->hasMany(AnswerStudentTest::class, 'answer_id', 'id');
    }
}
