<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 ini_set('memory_limit', -1);
class generate extends MY_Controller {
 
    public function __construct() {
            parent::__construct();
            $this->load->library('excel');
        }
 
        public function index()
    {
                $data['rs'] =  $this->db->get('countries');
                //$this->load->view('generate', $data);
                $this->mViewFile = 'generate';
                $this->mViewData = $data;
    }
        public function excel()
    {
                /*$this->excel->setActiveSheetIndex(0);
                //name the worksheet
                $this->excel->getActiveSheet()->setTitle('Countries');
                //set cell A1 content with some text
                $this->excel->getActiveSheet()->setCellValue('A1', 'Country Excel Sheet');
                $this->excel->getActiveSheet()->setCellValue('A4', 'S.No.');
                $this->excel->getActiveSheet()->setCellValue('B4', 'Country Code');
                $this->excel->getActiveSheet()->setCellValue('C4', 'Country Name');
                //merge cell A1 until C1
                $this->excel->getActiveSheet()->mergeCells('A1:C1');
                //set aligment to center for that merged cell (A1 to C1)
                $this->excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                //make the font become bold
                $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(16);
                $this->excel->getActiveSheet()->getStyle('A1')->getFill()->getStartColor()->setARGB('#333');
       for($col = ord('A'); $col <= ord('C'); $col++){
                //set column dimension
                $this->excel->getActiveSheet()->getColumnDimension(chr($col))->setAutoSize(true);
                 //change the font size
                $this->excel->getActiveSheet()->getStyle(chr($col))->getFont()->setSize(12);
                 
                $this->excel->getActiveSheet()->getStyle(chr($col))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        }
                //retrive contries table data
                $rs = $this->db->get('countries');
                $exceldata="";
        foreach ($rs->result_array() as $row){
                $exceldata[] = $row;
        }
                //Fill data 
                $this->excel->getActiveSheet()->fromArray($exceldata, null, 'A4');
                 
                $this->excel->getActiveSheet()->getStyle('A4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                $this->excel->getActiveSheet()->getStyle('B4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                $this->excel->getActiveSheet()->getStyle('C4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                 
                $filename='PHPExcelDemo.csv'; //save our workbook as this file name
                //header('Content-Type: application/vnd.ms-excel'); //mime type
                header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
                header('Cache-Control: max-age=0'); //no cache
 
                //save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
                //if you want to save it as .XLSX Excel 2007 format
                $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel2007');  
                //force user to download the Excel file without writing it to server's HD
                $objWriter->save('php://output');*/

                 
                 $query = $this->db->get('countries');

    if(!$query)
        return false;

    // Starting the PHPExcel library
    $this->load->library('excel');
    //$this->load->library('PHPexcel/IOFactory');

    $objPHPExcel = new PHPExcel();
    $objPHPExcel->getProperties()->setTitle("export")->setDescription("none");

    $objPHPExcel->setActiveSheetIndex(0);
     $objPHPExcel->getActiveSheet()->setTitle('Countries');
                //set cell A1 content with some text
                $objPHPExcel->getActiveSheet()->setCellValue('A1', 'Country Excel Sheet');
                $objPHPExcel->getActiveSheet()->setCellValue('B1', 'S.No.');
                $objPHPExcel->getActiveSheet()->setCellValue('C1', 'Country Code');
                $objPHPExcel->getActiveSheet()->setCellValue('D1', 'Country Name');
                //merge cell A1 until C1
                //$objPHPExcel->getActiveSheet()->mergeCells('A1:C1');
                //set aligment to center for that merged cell (A1 to C1)
                $objPHPExcel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                //make the font become bold
                $objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
                $objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setSize(16);
                $objPHPExcel->getActiveSheet()->getStyle('A1')->getFill()->getStartColor()->setARGB('#333');
                $rs = $this->db->get('countries');
                $exceldata="";
        foreach ($rs->result_array() as $row){
                
                $exceldata[] = $row;
        }   

                //Fill data 
                $objPHPExcel->getActiveSheet()->fromArray($exceldata, null, 'A4');
    // Field names in the first row
    /*$fields = $query->list_fields();
    $col = 0;
    foreach ($fields as $field)
    {
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, 1, $field);
        $col++;
    }

    // Fetching the table data
    $row = 2;
    foreach($query->result() as $data)
    {
        $col = 0;
        foreach ($fields as $field)
        {
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $data->$field);
            $col++;
        }

        $row++;
    }*/

    $objPHPExcel->setActiveSheetIndex(0);

    $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');

    // Sending headers to force the user to download the file
    header('Content-Type: application/vnd.ms-excel');
    header('Content-Disposition: attachment;filename="Products_'.date('dMy').'.xls"');
    header('Cache-Control: max-age=0');

    $objWriter->save('php://output');
                
 
                 
    }
         
}
 
/* End of file welcome.php */
/* Location: ./application/controllers/home.php */