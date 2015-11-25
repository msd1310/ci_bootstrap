<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
date_default_timezone_set("Asia/Kolkata");
error_reporting(0);


class Report extends MY_Controller {

    

	function __Construct(){
 		 parent::__Construct ();
		   $this->load->database(); // load database
		   $this->load->model('report_model'); // load model

           global $time_array;
           $time_array = array(
            ""=>"--select--",
            "00:00"=>"00:00",
            "01:00"=>"01:00",
            "02:00"=>"02:00",
            "03:00"=>"03:00",
            "04:00"=>"04:00",
            "05:00"=>"05:00",
            "06:00"=>"06:00",
            "07:00"=>"07:00",
            "08:00"=>"08:00",
            "09:00"=>"09:00",
            "10:00"=>"10:00",
            "11:00"=>"11:00",
            "12:00"=>"12:00",
            "13:00"=>"13:00",
            "14:00"=>"14:00",
            "15:00"=>"15:00",
            "16:00"=>"16:00",
            "17:00"=>"17:00",
            "18:00"=>"18:00",
            "19:00"=>"19:00",
            "20:00"=>"20:00",
            "21:00"=>"21:00",
            "22:00"=>"22:00",
            "23:00"=>"23:00",
			"24:00"=>"24:00",
        );
	}
    
	/**/


/*************************reports functions###******************/    
	public function index()
	{
		// CRUD table

        global $time_array;
        /*$id = array(); $val = array();
        foreach ($time_array as $key => $value) {
            array_push($id, $key);
            array_push($val, $value);
        }
      
        $time_result = array_combine($id, $val);
*/
		$this->load->helper('crud');
		$crud = generate_crud('parktype');
		$crud->unset_fields('');
		$crud->columns('name');
		$crud->callback_before_insert(array($this, 'callback_before_create_user'));

		$this->mTitle = "Estimate Report";
		$this->mViewFile = 'estimate_view';
		$this->mViewData['parktype'] = $this->report_model->get_department();
		$this->mViewData['slabtime'] = $this->report_model->get_slab_time();
        $this->mViewData['fromtime'] = $time_array;
		if($this->input->post()){

            //echo $this->input->post('fromtime').$this->input->post('totime');

			if(is_numeric($this->input->post('parktype'))){ $ptype = $this->input->post('parktype'); }else{$ptype='';}
			if(is_numeric($this->input->post('slabtime'))){ $stype = $this->input->post('slabtime'); }else{$stype='';}
			if(strtotime($this->input->post('fromdate'))){	
				$fdate = $this->input->post('fromdate');
				$fdate = date('Y-m-d',strtotime($fdate));
			}
                        if(strtotime($this->input->post('todate'))){
                                $tdate = $this->input->post('todate');
                                $tdate = date('Y-m-d',strtotime($tdate));
                        }
			if($this->input->post('hdnAction') == 'excel'){	
				if($fdate == '' and $tdate == ''){
					$fdate = date('Y-m-d'); $tdate = date('Y-m-d');
				}
				$this->ExportCSV_estimate($stype,$ptype,$fdate,$tdate);	
			}elseif(!empty($this->input->post('fromtime')) && !empty($this->input->post('totime')) ){
                    $ftime = $this->input->post('fromtime'); $ttime = $this->input->post('totime');
                     $fdate = $fdate.' '.$ftime.':00';
                     $tdate = $tdate.' '.$ttime.':00';

                     $this->mViewData['report_data'] = $this->report_model->select_estimate_data_time($ptype,$fdate,$tdate);
                }
                else{ 
				$this->mViewData['slab'] = $stype . $ptype . $fdate . $tdate;
				$this->mViewData['record'] = array('park'=>$ptype,'slab'=>$stype,'fdate'=>$fdate,'tdate'=>$tdate);
				if($stype == 3 ){ $tdate = date('Y-m-d', strtotime($tdate .' +1 day'));}
				$result_data = $this->report_model->select_estimate_data($ptype,$fdate,$tdate,$stype);
				if($stype == 3 ){
				   $tdate = $tdate .' '."07:00:00";
					foreach($result_data as $res){ 
						if(date('Y-m-d',strtotime($res->intime)) == date('Y-m-d',strtotime($tdate)) ){
							if($res->intime <= $tdate){
								//echo  $res->intime;
								$array_data[] = $res;
							}
						}
						if( date('Y-m-d',strtotime($res->intime)) != date('Y-m-d',strtotime($tdate)) ){
								
								$array_data[] = $res;
													}
					}
					$this->mViewData['report_data'] = $array_data;
				}else{
				$this->mViewData['report_data'] = $result_data;}
				//$this->mViewData['report_data'] = $this->report_model->select_estimate_data($ptype,$fdate,$tdate,$stype);
			}
		}else{
		$this->mViewData['report_data'] = $this->report_model->select_estimate_data($ptype = null,$fdate = null,$tdate = null,$stype = null);
		}
		
		
	}

    function vehicle_print($data) {

require_once("assets/escpos-php/Escpos.php");
try {
    // Enter the share name for your USB printer here
    $connector = new WindowsPrintConnector("epson");

    $printer = new Escpos($connector);

$age = array("Monday"=>"35", "Tuesday"=>"37", "Wednesday"=>"43");
$day = jddayofweek ( cal_to_jd(CAL_GREGORIAN, date("m"),date("d"), date("Y")) , 1 );
/* Print top logo */
/*print report start*/
 $exceldata="";
                $t_charges = 0;$total_hours = 0;
        foreach ($data->result_array() as $row){
                $pid = $row['pid'];
                $vtype = $row['name'];
                $noplate = $row['noplate'];
                $intime = $row['intime'];
                if($row['status'] == 0 ){ $status = 'IN';}
                if($row['status'] == 1 ){ $status = 'OUT';}

                if(isset($row['outtime'])){
                    $outtime = $row['outtime'];
                    $new_hours = $row['hours'];
                    $total_charges = $row['charges'];
                }else{
                    $in = $row['intime'];
                    $out = date('Y-m-d H:i:s',time());
                        $hour1 = 0; $hour2 = 0;
                        $date1 = $in;
                        $date2 = $out;
                        $datetimeObj1 = new DateTime($date1);
                        $datetimeObj2 = new DateTime($date2);
                        $interval = $datetimeObj1->diff($datetimeObj2);
                        if($interval->format('%a') > 0){
                        $hour1 = $interval->format('%a')*24;
                        }
                        if($interval->format('%h') > 0){
                        $hour2 = $interval->format('%h');
                        }
                        $hrs = $hour1+ $hour2; $hrs = sprintf("%02d",$hrs);
                        $minutes = $interval->format('%i');$minutes = sprintf("%02d",$minutes);
                        $secs = $interval->format('%s');$secs = sprintf("%02d",$secs);

                        $new_hours = $hrs.":".$minutes.":".$secs;

                $sql = "select charges from charges where typeid = (select id from parktype where name = '{$vtype}' )";
                $query = $this->db->query($sql);
                $result = $query->result();
                $result1 = array();
                foreach ($result as $key => $value) {
                    $result1['charges'] = $value->charges;
                }
                $charges =$result1['charges'];

                $tot_str = $hrs.'.'.$minutes;
                $hour_in_float = (float)$tot_str;
                $total_charges = (ceil($hour_in_float/8))*$charges;

               }
               $to_seconds = $this->time_to_seconds($new_hours);

               /*******total hours calculation*****/                              
    $total_hours = $total_hours + $to_seconds;
                                 
    $hours = floor($total_hours / (60 * 60));
    
    $divisor_for_minutes = $total_hours % (60 * 60);
    $minutes = floor($divisor_for_minutes / 60);
 
    // extract the remaining seconds
    $divisor_for_seconds = $divisor_for_minutes % 60;
    $seconds = ceil($divisor_for_seconds);
 
    $t_hours_sec = (int) $hours .':'.(int) $minutes.':'.(int) $seconds;
   /***********average hours calculation*********/
    $ave_hours = $total_hours/(count($data->result_array()));

    $hours = floor(($ave_hours) / (60 * 60));
    $divisor_for_minutes = $ave_hours % (60 * 60);
    $minutes = floor($divisor_for_minutes / 60);
    $divisor_for_seconds = $divisor_for_minutes % 60;
    $seconds = ceil($divisor_for_seconds);
    $ave_sec = (int) $hours .':'.(int) $minutes.':'.(int) $seconds;/*****************/



                $exceldata[] = array($pid,$vtype,$noplate,$intime,$row['outtime'],$new_hours,$total_charges,$status);
                $charges = $total_charges;
                $charges_t = $charges_t + $charges; 
                $ii = 1;
                $objPHPExcel->getActiveSheet()->getStyle('A'.$ii.':H'.$ii)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
                $ii++;
        }   
                $exceldata[] = array('','TOTAl :'.count($data->result_array()),'Total Hours :',$t_hours_sec,'average hours :',$ave_sec,'Total Charges  :',$charges_t);
                //$exceldata[] = array('','','','','','average hours :'.$ave_sec,'','');
                $excel_c = count($data->result_array()) +4;

                /*for($col = ord('A'.$excel_c); $col <= ord('F'.$excel_c); $col++){
                   $objPHPExcel->getActiveSheet()->getStyle(chr($col))->getFont()->setSize(14);
                    $objPHPExcel->getActiveSheet()->getStyle(chr($col))->getFont()->setBold(true);
                    $objPHPExcel->getActiveSheet()->getStyle(chr($col))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                }*/
                //$objPHPExcel->getActiveSheet()->getColumnDimension('G'.$excel_c)->setWidth(20);
                $objPHPExcel->getActiveSheet()->getRowDimension($excel_c)->setRowHeight(20);
                $objPHPExcel->getActiveSheet()->getStyle('A'.$excel_c.':H'.$excel_c)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
                $objPHPExcel->getActiveSheet()->getStyle('A'.$excel_c.':H'.$excel_c)->getFill()->getStartColor()->setARGB('29bb04');
                $objPHPExcel->getActiveSheet()->getStyle('A'.$excel_c.':H'.$excel_c)->getFont()->setSize(14);
                    $objPHPExcel->getActiveSheet()->getStyle('A'.$excel_c.':H'.$excel_c)->getFont()->setBold(true);
                    $objPHPExcel->getActiveSheet()->getStyle('A'.$excel_c.':H'.$excel_c)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

                //Fill data 
                $objPHPExcel->getActiveSheet()->fromArray($exceldata, null, 'A4');

/*print report end*/
$printer -> setJustification(Escpos::JUSTIFY_CENTER);

/* Name of shop */
$printer -> selectPrintMode(Escpos::MODE_DOUBLE_WIDTH);
$printer -> text("RECEIPT\n");
$printer -> text("\nNhavaSheva toll plaza\n");
$printer -> text("Operated By\n");
$printer -> text("Shree Sai Samartha\n");
$printer -> text("Enterprises Pay & Park\n");
$printer -> selectPrintMode();
$printer -> feed();

/* Title of receipt */

/* Items */

$printer -> setJustification(Escpos::JUSTIFY_LEFT);
$printer -> setEmphasis(true);
$printer -> setTextSize(2,1);
$rr = "RECEIPT NO :".$receipt."\n";
$printer -> text($rr);
//$printer -> feed();
$printer -> text("V. TYPE    :".$parktype."\n");
$printer -> feed();
$printer -> setTextSize(2,2);
$printer -> text("V.NO       :".$noplate."\n");
$printer -> text("CO. NO     :".$containerno."\n");
$printer -> text("VO. NO     :".$invoiceno."\n");
//$printer -> feed();
//$printer -> setTextSize(2,1);
$printer -> text("IN  DT :".date('d/m/Y',strtotime($intime))."\n");
$printer -> text("IN  TM :".date('h:i:s',strtotime($intime))."\n");
$printer -> setTextSize(2,2);
$printer -> setTextSize(1,1);

$printer -> setEmphasis(false);
$printer -> feed();

/* Tax and total */

/* Footer */
//$printer -> feed(1);
$printer -> setJustification(Escpos::JUSTIFY_CENTER);
$printer -> text("PARKING AT OWNERS RISK. MANAGEMENT IS NOT LIABLE\n");
$printer -> text("TO PAY ANY LOSS OR DAMAGE OF ANY VEHICLE OR\n");
$printer -> text("VALUABLE LEFT INSIDE IT\n");
//$printer -> feed(1);
//$printer -> text(date('l jS \of F Y h:i:s A') . "\n");

/* Cut the receipt and open the cash drawer */
$printer -> cut();
$printer -> pulse();

   $printer -> close();
} catch(Exception $e) {
    echo "Couldn't print to this printer: " . $e -> getMessage() . "\n";
}
/* A wrapper to do organise item names & prices into columns */
    /* Close printer */

}

public function ExportCSV_estimate($stype,$ptype,$fdate,$tdate)
{
        $this->load->dbutil();
        $this->load->helper('file');
        $this->load->helper('download');
        $delimiter = ",";
        $newline = "\r\n";
        $filename = "estimate_report"."_".date('Y-m-d').".csv";

	if($stype != '' and $ptype != '' and $fdate != '' and $tdate !=''){
$query = "SELECT id,(select name from parktype where park.typeid = parktype.id) as Vehicle_type,

noplate as Vehicle_number,intime,outtime,(timediff(now(),intime)) as hours,( 
  ceil(
        replace(
                time_format(
                        timediff(now(),intime), 
             '%H:%i'),
    ':','.')/8)
    ) * (select charges from charges where charges.typeid = park.typeid) as charges
        
        FROM park where status = 0 and slab_status = '{$stype}' and typeid = '{$ptype}' and (date(intime) >= '{$fdate}' and date(intime) <= '{$tdate}')";
	}elseif($stype == '' and $ptype == '' and $fdate != '' and $tdate !=''){
$query = "SELECT id,(select name from parktype where park.typeid = parktype.id) as typeid,

noplate,intime,outtime,(timediff(now(),intime)) as hours,( 
  ceil(
        replace(
                time_format(
                        timediff(now(),intime), 
             '%H:%i'),
    ':','.')/8)
    ) * (select charges from charges where charges.typeid = park.typeid) as charges
        
        FROM park where status = 0 and (date(intime) >= '{$fdate}' and date(intime) <= '{$tdate}')";
	}elseif($stype != '' and $ptype == '' and $fdate != '' and $tdate !=''){
$query = "SELECT id,(select name from parktype where park.typeid = parktype.id) as typeid,

noplate,intime,outtime,(timediff(now(),intime)) as hours,( 
  ceil(
        replace(
                time_format(
                        timediff(now(),intime), 
             '%H:%i'),
    ':','.')/8)
    ) * (select charges from charges where charges.typeid = park.typeid) as charges
        
        FROM park where status = 0 and slab_status = '{$stype}' and (date(intime) >= '{$fdate}' and date(intime) <= '{$tdate}')";
	}elseif($stype == '' and $ptype != '' and $fdate != '' and $tdate !=''){
$query = "SELECT id,(select name from parktype where park.typeid = parktype.id) as typeid,

noplate,intime,outtime,(timediff(now(),intime)) as hours,( 
  ceil(
        replace(
                time_format(
                        timediff(now(),intime), 
             '%H:%i'),
    ':','.')/8)
    ) * (select charges from charges where charges.typeid = park.typeid) as charges
        
        FROM park where status = 0 and typeid = '{$ptype}' and (date(intime) >= '{$fdate}' and date(intime) <= '{$tdate}')";
	}
	else{
        $query = "SELECT id,(select name from parktype where park.typeid = parktype.id) as typeid,

noplate,intime,outtime,(timediff(now(),intime)) as hours,( 
  ceil(
        replace(
                time_format(
                        timediff(now(),intime), 
             '%H:%i'),
    ':','.')/8)
    ) * (select charges from charges where charges.typeid = park.typeid) as charges
        
        FROM park where status = 0";
	}
        $result = $this->db->query($query);
        /*$data = $this->dbutil->csv_from_result($result, $delimiter, $newline);
        force_download($filename, $data);
                 //display success message
*/

        $this->load->library('excel');
    //$this->load->library('PHPexcel/IOFactory');

    $objPHPExcel = new PHPExcel();
    $objPHPExcel->getProperties()->setTitle("export")->setDescription("none");

    $objPHPExcel->setActiveSheetIndex(0);
     $objPHPExcel->getActiveSheet()->setTitle('Countries');
                //set cell A1 content with some text
                           $objPHPExcel->getActiveSheet()->setCellValue('A1', 'Estimate Report');
                            $objPHPExcel->getActiveSheet()->mergeCells('A1:D1');

                $objPHPExcel->getActiveSheet()->setCellValue('A3', 'P.ID');
                $objPHPExcel->getActiveSheet()->setCellValue('B3', 'Vehicle Type');
                $objPHPExcel->getActiveSheet()->setCellValue('C3', 'Vehicle Number');
                $objPHPExcel->getActiveSheet()->setCellValue('D3', 'In-time');
                //merge cell A1 until C1
                //$objPHPExcel->getActiveSheet()->mergeCells('D3:E3');
                $objPHPExcel->getActiveSheet()->setCellValue('E3', 'Total Hours Til Present Date');
                $objPHPExcel->getActiveSheet()->setCellValue('F3', 'Charges');
                //set aligment to center for that merged cell (A1 to C1)
                
                $objPHPExcel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                $objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
                $objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setSize(16);
                $objPHPExcel->getActiveSheet()->getStyle('A1')->getFill()->getStartColor()->setARGB('#333');


                $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(10);
                $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(20);
                $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(20);
                $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(20);
                $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(20);
                $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(20);

                /*for($col = ord('A3'); $col <= ord('F3'); $col++){
                    //set column dimension
                    //$this->excel->getActiveSheet()->getColumnDimension(chr($col))->setAutoSize(true);
                     //change the font size
                    $objPHPExcel->getActiveSheet()->getRowDimension(1)->setRowHeight(-1);
                    //$objPHPExcel->getActiveSheet()->getColumnDimension(chr($col))->setHight(10);
                    $objPHPExcel->getActiveSheet()->getStyle(chr($col))->getFont()->setSize(14);
                    $objPHPExcel->getActiveSheet()->getStyle(chr($col))->getFont()->setBold(true);
                    $objPHPExcel->getActiveSheet()->getStyle(chr($col))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                }*/

                $rs = $this->db->get('countries');
                $exceldata="";
                $total_charges = 0;
        foreach ($result->result_array() as $row){
                
                $exceldata[] = $row;
                $charges = $row['charges'];
                $total_charges = $total_charges + $charges;
        }   
                $exceldata[] = array('','IN :'.count($result->result_array()),'','Total Charges ',' ',' ',$total_charges);
                //Fill data 
                $objPHPExcel->getActiveSheet()->fromArray($exceldata, null, 'A4');

                $objPHPExcel->setActiveSheetIndex(0);

    $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');

    // Sending headers to force the user to download the file
    header('Content-Type: application/vnd.ms-excel');
    header('Content-Disposition: attachment;filename="Estimate_'.date('y-m-d').'.xls"');
    header('Cache-Control: max-age=0');

    $objWriter->save('php://output');
}

	public function collection()
        {
                 global $time_array;

                // CRUD table
                $this->load->helper('crud');
                $crud = generate_crud('parktype');
                $crud->unset_fields('');
                $crud->columns('name');
                $crud->callback_before_insert(array($this, 'callback_before_create_user'));

                $this->mTitle = "Collection Report";
                $this->mViewFile = 'collection_view';
                $this->mViewData['parktype'] = $this->report_model->get_department();
                $this->mViewData['slabtime'] = $this->report_model->get_slab_time();
                $this->mViewData['fromtime'] = $time_array;
                if($this->input->post()){
                        if(is_numeric($this->input->post('parktype'))){ $ptype = $this->input->post('parktype'); }else{$ptype='';}
                        if(is_numeric($this->input->post('slabtime'))){ $stype = $this->input->post('slabtime'); }else{$stype='';}
                        if(strtotime($this->input->post('fromdate'))){
                                $fdate = $this->input->post('fromdate');
                                $fdate = date('Y-m-d',strtotime($fdate));
                        }
                        if(strtotime($this->input->post('todate'))){
                                $tdate = $this->input->post('todate');
                                $tdate = date('Y-m-d',strtotime($tdate));
                        }
						if($this->input->post('hdnAction') == 'excel'){
                                if($fdate == '' and $tdate == ''){
                                        $fdate = date('Y-m-d'); $tdate = date('Y-m-d');
                                }
                                $data = $this->report_model->select_collection_excel_data($ptype,$fdate,$tdate,$stype);
                                $this->ExportCSV_collection2($data);
                        }
                        elseif(!empty($this->input->post('fromtime')) && !empty($this->input->post('totime')) ){
                             $ftime = $this->input->post('fromtime'); $ttime = $this->input->post('totime');
                             $fdate = $fdate.' '.$ftime.':00';
                             $tdate = $tdate.' '.$ttime.':00';

                             $this->mViewData['report_data'] = $this->report_model->select_collection_data_time($ptype,$fdate,$tdate);
                        }
                        else{
                                $this->mViewData['slab'] = $stype . $ptype . $fdate . $tdate;
                                $this->mViewData['record'] = array('park'=>$ptype,'slab'=>$stype,'fdate'=>$fdate,'tdate'=>$tdate);
								
								if($stype == 3 ){ $tdate = date('Y-m-d', strtotime($tdate .' +1 day'));}
    				$result_data = $this->report_model->select_collection_data($ptype,$fdate,$tdate,$stype);
    				if($stype == 3 ){
    				   $tdate = $tdate .' '."07:00:00";
    					foreach($result_data as $res){ 
    						if(date('Y-m-d',strtotime($res->intime)) == date('Y-m-d',strtotime($tdate)) ){
    							if($res->intime <= $tdate){
    								//echo  $res->intime;
    								$array_data[] = $res;
    							}
    						}
						if( date('Y-m-d',strtotime($res->intime)) != date('Y-m-d',strtotime($tdate)) ){
								
								$array_data[] = $res;
													}
					}
					$this->mViewData['report_data'] = $array_data;
				}else{
				$this->mViewData['report_data'] = $result_data;}
                                //$this->mViewData['report_data'] = $this->report_model->select_collection_data($ptype,$fdate,$tdate,$stype);
                        }
                }else{
                $this->mViewData['report_data'] = $this->report_model->select_collection_data($ptype = null,$fdate = date('Y-m-d'),$tdate = date('Y-m-d'),$stype = null);
                }
        }

    public function ExportCSV_collection2($data){
$this->load->library('excel');
    //$this->load->library('PHPexcel/IOFactory');

    $objPHPExcel = new PHPExcel();
    $objPHPExcel->getProperties()->setTitle("export")->setDescription("none");

    $objPHPExcel->setActiveSheetIndex(0);
     //$objPHPExcel->getActiveSheet()->setTitle('Countries');
                //set cell A1 content with some text
                            

                            $objPHPExcel->getActiveSheet()->setCellValue('A1', 'Collection Report');
                            $objPHPExcel->getActiveSheet()->mergeCells('A1:F1');
                            $objPHPExcel->getActiveSheet()->getRowDimension('1')->setRowHeight(30);
                            $objPHPExcel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                            $objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
                            $objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setSize(18);
                            $objPHPExcel->getActiveSheet()->getStyle('A1')->getFill()->getStartColor()->setARGB('333');


                $objPHPExcel->getActiveSheet()->getRowDimension('3')->setRowHeight(20);
                $objPHPExcel->getActiveSheet()->getStyle('A3:G3')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
                $objPHPExcel->getActiveSheet()->getStyle('A3:G3')->getFill()->getStartColor()->setARGB('21bc04');
                $objPHPExcel->getActiveSheet()->getStyle('A3:G3')->getFont()->setSize(14);
                $objPHPExcel->getActiveSheet()->getStyle('A3:G3')->getFont()->setBold(true);
                $objPHPExcel->getActiveSheet()->getStyle('A3:G3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

                $objPHPExcel->getActiveSheet()->setCellValue('A3', 'P.ID');
                $objPHPExcel->getActiveSheet()->setCellValue('B3', 'Vehicle Type');
                $objPHPExcel->getActiveSheet()->setCellValue('C3', 'Vehicle Number');
                $objPHPExcel->getActiveSheet()->setCellValue('D3', 'In-time');
                $objPHPExcel->getActiveSheet()->setCellValue('E3', 'Out-time');
                //merge cell A1 until C1
                //$objPHPExcel->getActiveSheet()->mergeCells('D3:E3');
                $objPHPExcel->getActiveSheet()->setCellValue('F3', 'Total Hours');
                $objPHPExcel->getActiveSheet()->setCellValue('G3', 'Charges');
                //set aligment to center for that merged cell (A1 to C1)
                
                


                //$objPHPExcel->getActiveSheet()->getColumnDimension('A:G')->setWidth(10);
                $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(10);
                $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(20);
                $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(20);
                $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(30);
                $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(30);
                $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(20);
                $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(20);

               
                //$rs = $this->db->get('countries');
                $exceldata="";
                $total_charges = 0;
        foreach ($data->result_array() as $row){
                
                $exceldata[] = $row;
                $charges = $row['charges'];
                $total_charges = $total_charges + $charges;
        }   
                $exceldata[] = array('','OUT :'.count($data->result_array()),'','Total Charges ',' ',' ',$total_charges);
                $excel_c = count($data->result_array()) +4;

                /*for($col = ord('A'.$excel_c); $col <= ord('F'.$excel_c); $col++){
                   $objPHPExcel->getActiveSheet()->getStyle(chr($col))->getFont()->setSize(14);
                    $objPHPExcel->getActiveSheet()->getStyle(chr($col))->getFont()->setBold(true);
                    $objPHPExcel->getActiveSheet()->getStyle(chr($col))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                }*/
                $objPHPExcel->getActiveSheet()->getRowDimension($excel_c)->setRowHeight(20);
                $objPHPExcel->getActiveSheet()->getStyle('A'.$excel_c.':G'.$excel_c)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
                $objPHPExcel->getActiveSheet()->getStyle('A'.$excel_c.':G'.$excel_c)->getFill()->getStartColor()->setARGB('29bb04');
                $objPHPExcel->getActiveSheet()->getStyle('A'.$excel_c.':G'.$excel_c)->getFont()->setSize(14);
                    $objPHPExcel->getActiveSheet()->getStyle('A'.$excel_c.':G'.$excel_c)->getFont()->setBold(true);
                    $objPHPExcel->getActiveSheet()->getStyle('A'.$excel_c.':G'.$excel_c)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

                //Fill data 
                $objPHPExcel->getActiveSheet()->fromArray($exceldata, null, 'A4');

                $objPHPExcel->setActiveSheetIndex(0);

    $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');

    // Sending headers to force the user to download the file
    header('Content-Type: application/vnd.ms-excel');
    header('Content-Disposition: attachment;filename="Collection'.date('y-m-d').'.xls"');
    header('Cache-Control: max-age=0');

    $objWriter->save('php://output');

    }
	/*public function ExportCSV_collection($stype,$ptype,$fdate,$tdate){

        $this->load->dbutil();
        $this->load->helper('file');
        $this->load->helper('download');
        $delimiter = ",";
        $newline = "\r\n";
        $filename = "collection_report"."_".date('Y-m-d').".xls";

          if($ptype != '' and $fdate != '' and $tdate != '' and $stype != ''){
		$query = "select id,(select name from parktype where park.typeid = parktype.id) as typeid,noplate,intime,outtime,hours,charges from park
			 where status = 1 and typeid = '{$ptype}' and slab_status = '{$stype}' and (date(intime) >= '{$fdate}' and date(intime) <= '{$tdate}')";
          }elseif($ptype != '' and $fdate != '' and $tdate != '' and $stype == ''){
                $query = "select id,(select name from parktype where park.typeid = parktype.id) as typeid,noplate,intime,outtime,hours,charges from park
                         where status = 1 and typeid = '{$ptype}' and (date(intime) >= '{$fdate}' and date(intime) <= '{$tdate}')";
          }elseif($ptype == '' and $fdate != '' and $tdate != '' and $stype != ''){
                $query = "select id,(select name from parktype where park.typeid = parktype.id) as typeid,noplate,intime,outtime,hours,charges from park
                         where status = 1 and slab_status = '{$stype}' and (date(intime) >= '{$fdate}' and date(intime) <= '{$tdate}')";
          }elseif($ptype == '' and $fdate == '' and $tdate == '' and $stype == ''){
                $query = "select id,(select name from parktype where park.typeid = parktype.id) as typeid,noplate,intime,outtime,hours,charges from park
                         where status = 1 and typeid = '{$ptype}' and slab_status = '{$stype}'";
          }else{
                $query = "select id,(select name from parktype where park.typeid = parktype.id) as typeid,noplate,intime,outtime,hours,charges from park
                         where status = 1 ";
          }
	
        $result = $this->db->query($query); 
        $data = $this->dbutil->csv_from_result($result,$delimiter,$newline);
        force_download($filename, $data);

	}*/
        public function complete_report()
        {
                global $time_array;
                // CRUD table
                $this->load->helper('crud');
                $crud = generate_crud('parktype');
                $crud->unset_fields('');
                $crud->columns('name');
                $crud->callback_before_insert(array($this, 'callback_before_create_user'));

                $this->mTitle = "Vehicle Report";
                $this->mViewFile = 'complete_view';
                $this->mViewData['parktype'] = $this->report_model->get_department();
                $this->mViewData['slabtime'] = $this->report_model->get_slab_time();
                $this->mViewData['fromtime'] = $time_array;
                if($this->input->post()){
                        if(is_numeric($this->input->post('parktype'))){ $ptype = $this->input->post('parktype'); }else{$ptype="";}
                        if(is_numeric($this->input->post('slabtime'))){ $stype = $this->input->post('slabtime'); }else{$stype="";}
                        if(is_numeric($this->input->post('reporttype'))){ $rtype = $this->input->post('reporttype'); }else{$rtype="";}
                        if(strtotime($this->input->post('fromdate'))){
                                $fdate = $this->input->post('fromdate');
                                $fdate = date('Y-m-d',strtotime($fdate));
                        }
                        if(strtotime($this->input->post('todate'))){
                                $tdate = $this->input->post('todate');
                                $tdate = date('Y-m-d',strtotime($tdate));
                        }
                $this->mViewData['slab'] = $stype . $ptype . $fdate . $tdate;
				
                if(!empty($this->input->post('fromtime')) && !empty($this->input->post('totime')) ){
                             $ftime = $this->input->post('fromtime'); $ttime = $this->input->post('totime');
                             $fdate = $fdate.' '.$ftime.':00';
                             $tdate = $tdate.' '.$ttime.':00';
                             if(is_numeric($this->input->post('reporttype'))){ $rtype = $this->input->post('reporttype'); }else{$rtype="3";}

                             if($this->input->post('hdnAction') == "excel"){
                                $excel_data = $this->report_model->select_complete_data_time_excel($ptype,$rtype,$fdate,$tdate);
                                $this->ExportCSV_complete($excel_data);
                             }
                             elseif($this->input->post('hdnAction') == "print"){
                                $excel_data = $this->report_model->select_complete_data_time_excel($ptype,$rtype,$fdate,$tdate);
                                $this->vehicle_print($excel_data);
                             }else{
                                $this->mViewData['report_data'] = $this->report_model->select_complete_data_time($ptype,$rtype,$fdate,$tdate);
                             }
                }else{  
                        if($this->input->post('hdnAction') == "excel"){ 
                                $excel_data = $this->report_model->select_complete_data_excel($ptype,$fdate,$tdate,$stype,$rtype);
                                //print_r($excel_data);
                                $this->ExportCSV_complete($excel_data);
                        }
                             elseif($this->input->post('hdnAction') == "print"){ 
                                $excel_data = $this->report_model->select_complete_data_excel($ptype,$fdate,$tdate,$stype,$rtype);
                                //print_r($excel_data);
                                $this->vehicle_print($excel_data);
                        }
                        else{
            				if($stype == 3 ){ $tdate = date('Y-m-d', strtotime($tdate .' +1 day'));}
            				$result_data = $this->report_model->select_complete_data($ptype,$fdate,$tdate,$stype,$rtype);
            				if($stype == 3 ){
            				   $tdate = $tdate .' '."07:00:00";
            					foreach($result_data as $res){ 
            						if(date('Y-m-d',strtotime($res->intime)) == date('Y-m-d',strtotime($tdate)) ){
            							if($res->intime <= $tdate){
            								//echo $res->intime;
            								$array_data[] = $res;
            							}
            						}
            						if( date('Y-m-d',strtotime($res->intime)) != date('Y-m-d',strtotime($tdate)) ){
            								
            								$array_data[] = $res;
            						}
            					} 
            					$this->mViewData['report_data'] = $array_data;
                                
            				}else{
            				  $this->mViewData['report_data'] = $result_data;
                            }
                        //$this->mViewData['report_data'] = $this->report_model->select_complete_data($ptype,$fdate,$tdate,$stype,$rtype);
                        }

                }
                    $data_array = array('ptype'=>$ptype,'rtype'=>$rtype,'fdate'=>$fdate,'tdate'=>$tdate,'ftime'=>$ftime,'ttime'=>$ttime);
                    $this->mViewData['data'] = $data_array;
                }/*******post if close****/
                else{ $fdate = $tdate = date('Y-m-d');
                $this->mViewData['report_data'] = $this->report_model->select_complete_data($ptype=null,$fdate,$tdate,$stype=null,$rtype=null);
                }
        }
	

    public function ExportCSV_complete($data){
    
    $this->load->library('excel');

    $objPHPExcel = new PHPExcel();
    $objPHPExcel->getProperties()->setTitle("export")->setDescription("none");

    $objPHPExcel->setActiveSheetIndex(0);                            

                            $objPHPExcel->getActiveSheet()->setCellValue('A1', 'Collection Report');
                            $objPHPExcel->getActiveSheet()->mergeCells('A1:F1');
                            $objPHPExcel->getActiveSheet()->getRowDimension('1')->setRowHeight(30);
                            $objPHPExcel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                            $objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
                            $objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setSize(18);
                            $objPHPExcel->getActiveSheet()->getStyle('A1')->getFill()->getStartColor()->setARGB('333');


                $objPHPExcel->getActiveSheet()->getRowDimension('3')->setRowHeight(20);
                $objPHPExcel->getActiveSheet()->getStyle('A3:H3')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
                $objPHPExcel->getActiveSheet()->getStyle('A3:H3')->getFill()->getStartColor()->setARGB('451050');
                $objPHPExcel->getActiveSheet()->getStyle('A3:H3')->getFont()->setSize(14);
                $objPHPExcel->getActiveSheet()->getStyle('A3:H3')->getFont()->setBold(true);
                $objPHPExcel->getActiveSheet()->getStyle('A3:H3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

                $objPHPExcel->getActiveSheet()->setCellValue('A3', 'P.ID');
                $objPHPExcel->getActiveSheet()->setCellValue('B3', 'Vehicle Type');
                $objPHPExcel->getActiveSheet()->setCellValue('C3', 'Vehicle Number');
                $objPHPExcel->getActiveSheet()->setCellValue('D3', 'In-time');
                $objPHPExcel->getActiveSheet()->setCellValue('E3', 'Out-time');
                //merge cell A1 until C1
                //$objPHPExcel->getActiveSheet()->mergeCells('D3:E3');
                $objPHPExcel->getActiveSheet()->setCellValue('F3', 'Total Hours');
                $objPHPExcel->getActiveSheet()->setCellValue('G3', 'Charges');
                $objPHPExcel->getActiveSheet()->setCellValue('H3', 'Status');
                
                


                //$objPHPExcel->getActiveSheet()->getColumnDimension('A:G')->setWidth(10);
                $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(10);
                $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(20);
                $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(20);
                $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(30);
                $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(30);
                $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(20);
                $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(20);
                $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(10);

               
               // $rs = $this->db->get('countries');
                $exceldata="";
                $t_charges = 0;$total_hours = 0;
        foreach ($data->result_array() as $row){
                $pid = $row['pid'];
                $vtype = $row['name'];
                $noplate = $row['noplate'];
                $intime = $row['intime'];
                if($row['status'] == 0 ){ $status = 'IN';}
                if($row['status'] == 1 ){ $status = 'OUT';}

                if(isset($row['outtime'])){
                    $outtime = $row['outtime'];
                    $new_hours = $row['hours'];
                    $total_charges = $row['charges'];
                }else{
                    $in = $row['intime'];
                    $out = date('Y-m-d H:i:s',time());
                        $hour1 = 0; $hour2 = 0;
                        $date1 = $in;
                        $date2 = $out;
                        $datetimeObj1 = new DateTime($date1);
                        $datetimeObj2 = new DateTime($date2);
                        $interval = $datetimeObj1->diff($datetimeObj2);
                        if($interval->format('%a') > 0){
                        $hour1 = $interval->format('%a')*24;
                        }
                        if($interval->format('%h') > 0){
                        $hour2 = $interval->format('%h');
                        }
                        $hrs = $hour1+ $hour2; $hrs = sprintf("%02d",$hrs);
                        $minutes = $interval->format('%i');$minutes = sprintf("%02d",$minutes);
                        $secs = $interval->format('%s');$secs = sprintf("%02d",$secs);

                        $new_hours = $hrs.":".$minutes.":".$secs;

                $sql = "select charges from charges where typeid = (select id from parktype where name = '{$vtype}' )";
                $query = $this->db->query($sql);
                $result = $query->result();
                $result1 = array();
                foreach ($result as $key => $value) {
                    $result1['charges'] = $value->charges;
                }
                $charges =$result1['charges'];

                $tot_str = $hrs.'.'.$minutes;
                $hour_in_float = (float)$tot_str;
                $total_charges = (ceil($hour_in_float/8))*$charges;

               }
               $to_seconds = $this->time_to_seconds($new_hours);

               /*******total hours calculation*****/                              
    $total_hours = $total_hours + $to_seconds;
                                 
    $hours = floor($total_hours / (60 * 60));
    
    $divisor_for_minutes = $total_hours % (60 * 60);
    $minutes = floor($divisor_for_minutes / 60);
 
    // extract the remaining seconds
    $divisor_for_seconds = $divisor_for_minutes % 60;
    $seconds = ceil($divisor_for_seconds);
 
    $t_hours_sec = (int) $hours .':'.(int) $minutes.':'.(int) $seconds;
   /***********average hours calculation*********/
    $ave_hours = $total_hours/(count($data->result_array()));

    $hours = floor(($ave_hours) / (60 * 60));
    $divisor_for_minutes = $ave_hours % (60 * 60);
    $minutes = floor($divisor_for_minutes / 60);
    $divisor_for_seconds = $divisor_for_minutes % 60;
    $seconds = ceil($divisor_for_seconds);
    $ave_sec = (int) $hours .':'.(int) $minutes.':'.(int) $seconds;/*****************/



                $exceldata[] = array($pid,$vtype,$noplate,$intime,$row['outtime'],$new_hours,$total_charges,$status);
                $charges = $total_charges;
                $charges_t = $charges_t + $charges; 
                $ii = 1;
                $objPHPExcel->getActiveSheet()->getStyle('A'.$ii.':H'.$ii)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
                $ii++;
        }   
                $exceldata[] = array('','TOTAl :'.count($data->result_array()),'Total Hours :',$t_hours_sec,'average hours :',$ave_sec,'Total Charges  :',$charges_t);
                //$exceldata[] = array('','','','','','average hours :'.$ave_sec,'','');
                $excel_c = count($data->result_array()) +4;

                /*for($col = ord('A'.$excel_c); $col <= ord('F'.$excel_c); $col++){
                   $objPHPExcel->getActiveSheet()->getStyle(chr($col))->getFont()->setSize(14);
                    $objPHPExcel->getActiveSheet()->getStyle(chr($col))->getFont()->setBold(true);
                    $objPHPExcel->getActiveSheet()->getStyle(chr($col))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                }*/
                //$objPHPExcel->getActiveSheet()->getColumnDimension('G'.$excel_c)->setWidth(20);
                $objPHPExcel->getActiveSheet()->getRowDimension($excel_c)->setRowHeight(20);
                $objPHPExcel->getActiveSheet()->getStyle('A'.$excel_c.':H'.$excel_c)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
                $objPHPExcel->getActiveSheet()->getStyle('A'.$excel_c.':H'.$excel_c)->getFill()->getStartColor()->setARGB('29bb04');
                $objPHPExcel->getActiveSheet()->getStyle('A'.$excel_c.':H'.$excel_c)->getFont()->setSize(14);
                    $objPHPExcel->getActiveSheet()->getStyle('A'.$excel_c.':H'.$excel_c)->getFont()->setBold(true);
                    $objPHPExcel->getActiveSheet()->getStyle('A'.$excel_c.':H'.$excel_c)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

                //Fill data 
                $objPHPExcel->getActiveSheet()->fromArray($exceldata, null, 'A4');

                $objPHPExcel->setActiveSheetIndex(0);

    $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');

    // Sending headers to force the user to download the file
    header('Content-Type: application/vnd.ms-excel');
    header('Content-Disposition: attachment;filename="Vehicle'.date('y-m-d').'.xls"');
    header('Cache-Control: max-age=0');

    $objWriter->save('php://output');

    }

    public function time_to_seconds($time){
        $split_time = explode(':', $time);
        $modifier = pow(60, count($split_time) - 1);
        $seconds = 0;
        foreach($split_time as $time_part){
            $seconds += ($time_part * $modifier);
            $modifier /= 60;
        }
        return $seconds;
    }
	/**
	 * Grocery Crud callback functions
	 */
	public function callback_before_create_user($post_array)
	{
		$post_array['password'] = hash_pw($post_array['password']);
		return $post_array;
	}
}
