<?php

class IndexController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        $this->view->a = $this->_request->getParam('a', 100);

        echo $this->_request->getParam('param');

    }

    public function reportAction() {
        $this->_helper->layout()->disableLayout();
        $this->_helper->viewRenderer->setNoRender(true);

        $spreadsheet = new PhpOffice\PhpSpreadsheet\Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', 'Hello World !');

        $writer = new PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
//        $writer->save('hello world.xlsx');

        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment; filename="hello world.xlsx"');
        $writer->save("php://output");

    }

}

