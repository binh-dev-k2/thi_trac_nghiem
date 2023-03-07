<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class answer_student_test extends Model
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
        return $this->belongsTo(student_test::class, 'student_test_id', 'id');
    }
    public function answer()
    {
        return $this->belongsTo(answer::class, 'answer_id', 'id');
    }
}
