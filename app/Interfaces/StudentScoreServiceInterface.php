<?php 

namespace App\Interfaces;

interface StudentScoreServiceInterface
{

    public function getSubjectsHeaders();

    public function getScoreStatistics();

    public function getTopStudents();

    public function findStudentByRegistrationNumber(string $number);
}
