<?php

namespace App\Services;

use App\Models\StudentScore;
use App\Interfaces\StudentScoreServiceInterface;

class StudentScoreService implements StudentScoreServiceInterface
{
    protected $studentScoreModel;

    public function __construct(StudentScore $studentScoreModel)
    {
        $this->studentScoreModel = $studentScoreModel;
    }
    public function getSubjectsHeaders()
    {
        return ['Subject', 'Excellent', 'Good', 'Average', 'Weak'];
    }
    public function getScoreStatistics()
    {
        $subjects = $this->studentScoreModel->getSubjects();
        $statistics = [];

        foreach ($subjects as $subject) {
            $statistics[$subject] = [
                'Excellent' => StudentScore::whereNotNull($subject)->where($subject, '>=', 8)->count(),
                'Good'      => StudentScore::whereNotNull($subject)->whereBetween($subject, [6, 7.99])->count(),
                'Average'   => StudentScore::whereNotNull($subject)->whereBetween($subject, [4, 5.99])->count(),
                'Weak'      => StudentScore::whereNotNull($subject)->where($subject, '<', 4)->count(),
            ];
        }

        return $statistics;
    }

    public function getTopStudents()
    {
        return StudentScore::whereNotNull('math')
            ->whereNotNull('physics')
            ->whereNotNull('chemistry')
            ->orderByRaw('(math + physics + chemistry)/3 DESC')
            ->limit(10)
            ->get();
    }

    public function findStudentByRegistrationNumber(string $number)
    {
        return StudentScore::where('registration_number', $number)->first();
    }
}
