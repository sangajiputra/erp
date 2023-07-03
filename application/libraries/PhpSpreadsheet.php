<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

require_once APPPATH . 'libraries/PhpSpreadsheet/IOFactory.php';

class PhpSpreadsheet {

    public function export($data) {
        $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        
        // Write data to cells
        $sheet->fromArray($data);
        
        // Set header for downloading
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="data.xlsx"'); 
        header('Cache-Control: max-age=0');
        
        // Save the file
        $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xlsx');
        $writer->save('php://output');
    }
}
