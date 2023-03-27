<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    use HasFactory;
    protected $table = 'exams';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id',
        'user_id',
        'time',
        'count_participants',
        'count_participanted',
        'start_time',
        'stop_time',
        'name',
        'question_per_exams',
        'is_see_result',
        'status',
        'matrix',
    ];
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    public function question()
    {
        return $this->hasMany(Question::class, 'exam_id', 'id');
    }

}
