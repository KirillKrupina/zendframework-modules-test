<?php

class Core_Model_Reports_UsersReportXLS {
    static function generate(array $users, $fileName = 'myReport.xls') {

        try {
            $spreadsheet = new PhpOffice\PhpSpreadsheet\Spreadsheet();
            $sheet = $spreadsheet->getActiveSheet();
        } catch (\PhpOffice\PhpSpreadsheet\Exception $e) {
            $e->getMessage();
        }


        try {

            foreach ($users as $index => $user) {
                $sheet->setCellValue('A'. ($index+1), $user['id']);
                self::setStyleId($sheet,'A'. ($index+1));

                $sheet->setCellValue('B'. ($index+1), $user['fullname']);
                self::setStyleId($sheet,'B'. ($index+1));

                $sheet->setCellValue('C'. ($index+1), $user['email']);
                self::setStyleId($sheet,'C'. ($index+1));
            }
        } catch (\PhpOffice\PhpSpreadsheet\Exception $e) {
            $e->getMessage();
        }


        try {
            $writer = new PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
            header('Content-Type: application/vnd.ms-excel');
            header('Content-Disposition: attachment; filename="hello world.xlsx"');
            $writer->save("php://output");
        } catch (\PhpOffice\PhpSpreadsheet\Writer\Exception $e) {
            $e->getMessage();
        }
    }

    static function setStyleId($worksheet, $cellCord) {
        $worksheet->getStyle($cellCord)->applyFromArray([
            'font' => [
                'name'=>'Arial',
                'bold' => true,
                'italic' => false,
                'underline' => \PhpOffice\PhpSpreadsheet\Style\Font::UNDERLINE_DOUBLE,
                'color' => [ 'rgb' => '808080' ]
            ],
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => [ 'rgb' => '808080']
                ]
            ],
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                'wrapText' => true
            ]
        ]);
    }
}
