<?php
namespace App\Exports;

use App\Models\StudentScore;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ScoreStatisticsExport implements FromArray, WithHeadings
{
    protected $subjects;

    public function __construct($subjects)
    {
        $this->subjects = $subjects;
    }

    public function array(): array
    {
        $scoreStatistics = [];

        foreach ($this->subjects as $subject) {
            $scoreStatistics[] = [
                'Subject'   => $subject,
                'excellent' => StudentScore::whereNotNull($subject)->where($subject, '>=', 8)->count(),
                'good'      => StudentScore::whereNotNull($subject)->whereBetween($subject, [6, 7.99])->count(),
                'average'   => StudentScore::whereNotNull($subject)->whereBetween($subject, [4, 5.99])->count(),
                'weak'      => StudentScore::whereNotNull($subject)->where($subject, '<', 4)->count(),
            ];
        }

        return $scoreStatistics;
    }

    public function headings(): array
    {
        return ['Subject', 'excellent', 'good', 'average', 'weak'];
    }
}
