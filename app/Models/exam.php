<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class exam extends Model
{
    use HasFactory;
    protected $table = 'exams';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id',
        'user_id',
        'time',
        'count_participants',
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
        return $this->hasMany(question::class, 'exam_id', 'id');
    }
    
}
