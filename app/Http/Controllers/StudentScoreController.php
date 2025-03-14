<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StudentScore;
use App\Http\Requests\StudentScoreRequest;
use Illuminate\Support\Facades\Schema;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ScoreStatisticsExport;
class StudentScoreController extends Controller
{
    public function export()
    {
        $columns = Schema::getColumnListing('student_scores');
        $excludedColumns = ['id', 'registration_number', 'created_at', 'updated_at', 'foreign_language_code'];
        $subjects = array_diff($columns, $excludedColumns);

        return Excel::download(new ScoreStatisticsExport($subjects), 'score-statistics.xlsx');
    }
    public function search(Request $request)
    {
        $request->validate([
            'registration_number' => 'required|numeric|digits_between:1,10'
        ]);
        $student = StudentScore::where('registration_number', $request->registration_number)->first();
        if (!$student) {
            return redirect()->back()->with('error', '❌ Không tìm thấy sinh viên!');
        }
        return view('search-scores', compact('student'));
    }
   
    public function report()
    {
        
        $columns = Schema::getColumnListing('student_scores');
        $excludedColumns = ['id', 'registration_number', 'created_at', 'updated_at', 'foreign_language_code'];
        $subjects = array_diff($columns, $excludedColumns);
    
       
        $scoreStatistics = [];
    
        foreach ($subjects as $subject) {
            $scoreStatistics[$subject] = [
                'excellent' => StudentScore::whereNotNull($subject)->where($subject, '>=', 8)->count(),
                'good'      => StudentScore::whereNotNull($subject)->whereBetween($subject, [6, 7.99])->count(),
                'average'   => StudentScore::whereNotNull($subject)->whereBetween($subject, [4, 5.99])->count(),
                'weak'      => StudentScore::whereNotNull($subject)->where($subject, '<', 4)->count(),
            ];
        }
  
       
        $students = StudentScore::whereNotNull('math')
        ->whereNotNull('physics')
        ->whereNotNull('chemistry')
        ->orderByRaw("(math + physics + chemistry) / 3 DESC")
        ->limit(10)
        ->get();
      
        return view('reports', compact('scoreStatistics', 'students'));
    }
    

    
}
