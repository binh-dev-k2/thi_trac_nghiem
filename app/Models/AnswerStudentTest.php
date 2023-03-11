<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnswerStudentTest extends Model
{
    use HasFactory;
    protected $table = 'answer_student_tests';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id',
        'student_test_id',
        'question_id',
        'answer_id',
    ];
    public function studenTest()
    {
        return $this->belongsTo(StudentTest::class, 'student_test_id', 'id');
    }
    public function answer()
    {
        return $this->belongsTo(Answer::class, 'answer_id', 'id');
    }
}
