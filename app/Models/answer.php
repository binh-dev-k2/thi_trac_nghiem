<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class answer extends Model
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
        return $this->belongsTo(question::class, 'question_id', 'id');
    }
    public function answerStudentTest()
    {
        return $this->hasMany(answer_student_test::class, 'answer_id', 'id');
    }
}
