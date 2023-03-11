<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentTest extends Model
{
    use HasFactory;
    protected $table = 'student_tests';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id',
        'student_id',
        'test_id',
        'scores'
    ];
    public function student()
    {
        return $this->belongsTo(User::class, 'student_id', 'id');
    }
    public function test()
    {
        return $this->belongsTo(Test::class, 'test_id', 'id');
    }
}
