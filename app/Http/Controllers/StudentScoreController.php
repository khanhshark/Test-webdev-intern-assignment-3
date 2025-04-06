<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Interfaces\StudentScoreServiceInterface;
use App\Services\ExportScoreService;

class StudentScoreController extends Controller
{
    protected $studentScoreService;
    protected $exportScoreService;

    public function __construct(
        StudentScoreServiceInterface $studentScoreService,
        ExportScoreService $exportScoreService
    ) {
        $this->studentScoreService = $studentScoreService;
        $this->exportScoreService = $exportScoreService;
    }

    public function search(Request $request)
    {
        $request->validate([
            'registration_number' => 'required|numeric|digits_between:1,10'
        ]);
        $student = $this->studentScoreService->findStudentByRegistrationNumber($request->registration_number);
        if (!$student) {
            return redirect()->back()->with('error', 'Không tìm thấy sinh viên!');
        }

        return view('search-scores', compact('student'));
    }
   
    public function report()
    {
        
        $scoreStatistics = $this->studentScoreService->getScoreStatistics();
        $students = $this->studentScoreService->getTopStudents();
      
        return view('reports', compact('scoreStatistics', 'students'));
    }
    
    public function export()
    {
        $subjectsHeaders = $this->studentScoreService->getSubjectsHeaders();
        $scoreStatistics = $this->studentScoreService->getScoreStatistics();

        return $this->exportScoreService->exportScoreStatistics($scoreStatistics, $subjectsHeaders);
    }
    
}
