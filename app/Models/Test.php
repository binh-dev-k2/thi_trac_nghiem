<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Test extends Model
{
    use HasFactory;
    protected $table = 'tests';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id',
        'exam_id',
        'slug'
    ];
    public function exam()
    {
        return $this->belongsTo(exam::class, 'exam_id', 'id');
    }
    public function studentTest()
    {
        return $this->hasMany(student_test::class, 'test_id', 'id');
    }
    public function testQuestion()
    {
        return $this->hasMany(TestQuestion::class, 'test_id', 'id');
    }
}
