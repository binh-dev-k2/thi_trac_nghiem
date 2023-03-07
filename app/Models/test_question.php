<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class test_question extends Model
{
    use HasFactory;
    protected $table = 'test_questions';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id',
        'test_id',
        'question_id',
    ];
    public function question()
    {
        return $this->belongsTo(question::class, 'question_id', 'id');
    }
    public function test()
    {
        return $this->belongsTo(Test::class, 'test_id', 'id');
    }
}
