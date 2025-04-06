<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentScore extends Model
{
    //
    use HasFactory;
    protected $table = 'student_scores'; 
    protected $fillable = [
        'registration_number',
        'math',
        'literature',
        'foreign_language',
        'physics',
        'chemistry',
        'biology',
        'history',
        'geography',
        'civic_education',
        'foreign_language_code',
    ];

    public  function getSubjects()
    {
        return [
            'math',
            'literature',
            'foreign_language',
            'physics',
            'chemistry',
            'biology',
            'history',
            'geography',
            'civic_education'
        ];
    }
}
