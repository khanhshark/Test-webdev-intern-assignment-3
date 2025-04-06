<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ScoreStatisticsExport implements FromCollection, WithHeadings
{
    protected $subjects;
    protected $statistics;
    protected $headings;

    public function __construct(array $statistics,array $headings = [])
    {
        $this->statistics = $statistics;
        $this->headings = $headings;
    }

    public function collection()
    {
        $data = [];
        $subjects = array_keys($this->statistics);
       
        foreach ($subjects as $subject) {
            $row = [$subject];
            for ($i = 1; $i < count($this->headings); $i++) {
                $heading = $this->headings[$i];
                $row[] = isset($this->statistics[$subject][$heading]) 
                            ? $this->statistics[$subject][$heading] 
                            : 0;
            }
            $data[] = $row;
        }
    
        return collect($data);
    }
    

    public function headings(): array
    {
        return $this->headings;
    }
}
