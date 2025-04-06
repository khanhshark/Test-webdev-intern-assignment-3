<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Validator;
use League\Csv\Reader;

class StudentScoresSeeder extends Seeder {
    public function run() {
        $filePath = storage_path('app/public/diem_thi_thpt_2024.csv');
        if (!file_exists($filePath)) {
            echo "CSV file not found!\n";
            return;
        }
        $csv = Reader::createFromPath($filePath, 'r');
        $csv->setHeaderOffset(0); 
        $records = $csv->getRecords();
        $insertData = [];
        foreach ($records as $record) {
            $validator = Validator::make($record, [
                'sbd'        => 'required|string|max:10|unique:student_scores,registration_number',
                'toan'       => 'nullable|numeric|min:0|max:10',
                'ngu_van'    => 'nullable|numeric|min:0|max:10',
                'ngoai_ngu'  => 'nullable|numeric|min:0|max:10',
                'vat_li'     => 'nullable|numeric|min:0|max:10',
                'hoa_hoc'    => 'nullable|numeric|min:0|max:10',
                'sinh_hoc'   => 'nullable|numeric|min:0|max:10',
                'lich_su'    => 'nullable|numeric|min:0|max:10',
                'dia_li'     => 'nullable|numeric|min:0|max:10',
                'gdcd'       => 'nullable|numeric|min:0|max:10',
                'ma_ngoai_ngu' => 'nullable|string|max:5'
            ]);

            if ($validator->fails()) {
                echo "Dữ liệu không hợp lệ cho SBD: {$record['sbd']}\n";
                continue;
            }
            $insertData[] = [
                'registration_number'   => trim($record['sbd']),
                'math'                  => $this->convertToDecimal($record['toan']),
                'literature'            => $this->convertToDecimal($record['ngu_van']),
                'foreign_language'      => $this->convertToDecimal($record['ngoai_ngu']),
                'physics'               => $this->convertToDecimal($record['vat_li']),
                'chemistry'             => $this->convertToDecimal($record['hoa_hoc']),
                'biology'               => $this->convertToDecimal($record['sinh_hoc']),
                'history'               => $this->convertToDecimal($record['lich_su']),
                'geography'             => $this->convertToDecimal($record['dia_li']),
                'civic_education'       => $this->convertToDecimal($record['gdcd']),
                'foreign_language_code' => trim($record['ma_ngoai_ngu']) ?: null,
                'created_at'            => now(),
                'updated_at'            => now(),
            ]; 

            if (count($insertData) >= 500) {
                DB::table('student_scores')->insert($insertData);
                $insertData = []; 
            }
        }
        if (!empty($insertData)){
            DB::table('student_scores')->insert($insertData);
        }
           
            
        echo "Data has been added to the database!\n";   
    }
    private function convertToDecimal($value) {
        return ($value === '' || $value === null) ? null : (float) $value;
    }
}
