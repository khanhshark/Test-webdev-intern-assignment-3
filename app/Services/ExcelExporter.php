<?php

namespace App\Services;

use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ScoreStatisticsExport;
use App\Interfaces\ExporterInterface;

class ExcelExporter implements ExporterInterface
{
    public function export(array $data,array $head = [])
    {
        return Excel::download(new ScoreStatisticsExport($data,$head), 'score-statistics.xlsx');
    }
}
