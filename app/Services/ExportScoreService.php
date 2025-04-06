<?php

namespace App\Services;

use App\Interfaces\ExporterInterface;

class ExportScoreService
{
    protected $exporter;

    public function __construct(ExporterInterface $exporter)
    {
        $this->exporter = $exporter;
    }

    public function exportScoreStatistics(array $data, array $head = [])
    {
        return $this->exporter->export($data, $head);
    }
}
