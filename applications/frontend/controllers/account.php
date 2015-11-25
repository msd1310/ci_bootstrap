<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//BOOTSTRAPLL
date_default_timezone_set("Asia/Kolkata");

class Account extends MY_Controller {


	public function __construct()
	{
		parent::__construct();

		if (!ENABLED_MEMBERSHIP) {
			redirect();
			exit;
		}
		$this->load->library('session');
		$this->load->helper('form');
		$this->load->helper('url');
		$this->load->database();
		$this->load->library('form_validation');
		//load the employee model
		$this->load->model('employee_model');
		$this->load->model('User_model', 'users');
		$this->load->model('Aaa_model', 'aaa');
		$this->load->helper('email');
		$this->load->library('pagination');
    $this->load->library('excel');
	}

	// Account Dashboard / Home
	public function index()
	{
		if($this->input->post()){
                            $username = $this->input->post('username');
                            $password = $this->input->post('password');

				$user = $this->users->get_by([
						'username'		=> $username,
						'active'	=> 1
					]);
		if(!empty($user)){

			// check password
				if (verify_pw($password, $user['password']) )
				{
					// limited fields to store in session
					$fields = array('id', 'role', 'first_name', 'last_name', 'email', 'created_at');
					$user_data = elements($fields, $user);
					login_user($user_data);

					$this->session->sess_expire_on_close = True;
					$this->session->sess_update();


					// success
	 $this->session->set_flashdata('msg_success', '<div class="alert alert-success text-center">Login Successful !</div>');
					redirect('account/insertdata');
					exit;
				}
			else{
	 $this->session->set_flashdata('msg', '<div class="alert alert-danger text-center">Please enter valid username and password!</div>');
				redirect('account/');
			}
  		  }/* user empty loop*/
			else{
    $this->session->set_flashdata('msg', '<div class="alert alert-danger text-center">Please enter valid username and password!</div>');
			redirect('account/');
			}
		 }/***post data **/

		$this->mTitle = "Account";
		//$this->mViewFile = 'account/index';
		$this->mViewFile = 'login';

	}

	public function logout_user()
	    {

	        $this->session->sess_destroy();
	        redirect('account/');
	    }

	public function pagelist() {
		//echo "welcome";
		$this->load->model('employee_model');
		$this->load->library('pagination');
		$config = array();
		$config["base_url"] = base_url() . "index.php/employee/pagelist/";
		$config["total_rows"] = $this->employee_model->record_count();
		$config["per_page"] = 10;
		print_r($config);
		//pagination customization using bootstrap styles
		$config['full_tag_open'] = '<div class="pagination pagination-centered"><ul class="page_test">'; // I added class name 'page_test' to used later for jQuery
		$config['full_tag_close'] = '</ul></div><!--pagination-->';
		$config['first_link'] = '&laquo; First';
		$config['first_tag_open'] = '<li class="prev page">';
		$config['first_tag_close'] = '</li>';

		$config['last_link'] = 'Last &raquo;';
		$config['last_tag_open'] = '<li class="next page">';
		$config['last_tag_close'] = '</li>';

		$config['next_link'] = 'Next &rarr;';
		$config['next_tag_open'] = '<li class="next page">';
		$config['next_tag_close'] = '</li>';

		$config['prev_link'] = '&larr; Previous';
		$config['prev_tag_open'] = '<li class="prev page">';
		$config['prev_tag_close'] = '</li>';

		$config['cur_tag_open'] = '<li class="active"><a href="">';
		$config['cur_tag_close'] = '</a></li>';

		$config['num_tag_open'] = '<li class="page">';
		$config['num_tag_close'] = '</li>';

		$this->pagination->initialize($config);
		$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		$data['page'] = $page;

		$data["results"] = $this->employee_model->fetch_record($config["per_page"], $page);

		//check if ajax is called
		if($this->input->post('ajax', FALSE))
		{

			echo json_encode(array(
				'results' => $data["results"],
				'pagination' => $this->pagination->create_links()
			));
		}

		//load the view
		$this->mViewFile = 'pagelist_view';
		$this->mViewData = $data;

}

public function pagination(){
			 $page_number = $this->input->post('page_number');
			 $item_per_page =10;
			 $position = ($page_number*$item_per_page);
			 $result_set = $this->db->query("SELECT * FROM park LIMIT ".$position.",".$item_per_page);
			 $total_set =  $result_set->num_rows();
			 $page =  $this->db->get('park') ;
			 $total =  $page->num_rows();
			 //break total record into pages
			 $total = ceil($total/$item_per_page);
			 if($total_set>0){
					 $entries = null;
	 // get data and store in a json array
					 foreach($result_set->result() as $row){
								$entries[] = $row;
					 }
					 $result = array(
							 'TotalRows' => $total,
							 'Rows' => $entries


					 );
					 $this->output->set_content_type('application/json');
					 echo json_encode(array($result));
			 }
			 exit;

	}




 public function dindex()
{
	$this->load->model('department_model');
		//pagination settings
		$config['base_url'] = site_url('account/dindex');
		$config['total_rows'] = $this->db->count_all('tbl_dept');
		$config['per_page'] = "5";
		$config["uri_segment"] = 3;
		$choice = $config["total_rows"] / $config["per_page"];
		$config["num_links"] = floor($choice);

		//config for bootstrap pagination class integration
		$config['full_tag_open'] = '<ul class="pagination">';
		$config['full_tag_close'] = '</ul>';
		$config['first_link'] = false;
		$config['last_link'] = false;
		$config['first_tag_open'] = '<li>';
		$config['first_tag_close'] = '</li>';
		$config['prev_link'] = '&laquo';
		$config['prev_tag_open'] = '<li class="prev">';
		$config['prev_tag_close'] = '</li>';
		$config['next_link'] = '&raquo';
		$config['next_tag_open'] = '<li>';
		$config['next_tag_close'] = '</li>';
		$config['last_tag_open'] = '<li>';
		$config['last_tag_close'] = '</li>';
		$config['cur_tag_open'] = '<li class="active"><a href="#">';
		$config['cur_tag_close'] = '</a></li>';
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';

		$this->pagination->initialize($config);
		$data['page'] = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

		//call the model function to get the department data
		$data['deptlist'] = $this->department_model->get_department_list($config["per_page"], $data['page']);

		$data['pagination'] = $this->pagination->create_links();

		//load the department_view
		//$this->load->view('department_view',$data);
		$this->mViewFile = 'department_view';
		$this->mViewData = $data;
}

public function userlist() {
				$this->mViewFile = 'account/userlist';
}

	public function updateConfirm($id){

		$data['parkrecord'] = $this->employee_model->get_park_record($id);

		 echo $dd = $data['parkrecord'][0]->intime;
                                                 $data = array(
                                                         'pid' => $data['parkrecord'][0]->pid,
                                                         'typeid' => $data['parkrecord'][0]->typeid,
                                                         'noplate' => $data['parkrecord'][0]->noplate,
                                                         'intime' => $data['parkrecord'][0]->intime,
                                                         'outtime' => $data['parkrecord'][0]->outtime,
                                                         'hours' => $data['parkrecord'][0]->hours,
                                                         'charges' => $data['parkrecord'][0]->charges,
                                                         'confirm' => '1',
                                                         'status' => '0',
                                                 );

                 $this->db->where('pid', $id);
                 $this->db->update('park', $data);
                                                         //display success message
                 $this->session->set_flashdata('msg', '<div class="alert alert-success text-center">Employee Record is Successfully Updated!</div>');
                 redirect('account/cg/');

	}
	public function getjsondata(){
		header('Content-Type: application/json');
		$data['result'] = $this->employee_model->get_park_record_json();
		echo json_encode($data["result"]);
		$this->mViewFile = 'tables';
	}
	public function updateEmployee($empno) {

		// redirect to Login page if user not logged in
		$this->mUser = get_user();
		if ( empty($this->mUser) )
		{
			redirect('account/');
			exit;
		}
					 $data['empno'] = $empno;
					 $this->load->model('employee_model');
					 //fetch data from department and designation tables
					 $data['parktype'] = $this->employee_model->get_department();
					 //fetch employee record for the given employee no
					 $data['emprecord'] = $this->employee_model->get_park_record($empno);
					 //print_r($data['emprecord'][0]);
					 $dd = $data['emprecord'][0];
					  $timee = $dd->hours;
					 $typeid = $dd->typeid;
					 $data['time'] = $this->employee_model->get_slab($timee);
					 $data['charges'] = $this->employee_model->get_charges($timee,$typeid);

					 $this->form_validation->set_rules('id', 'Id', 'trim|numeric');
					 $this->form_validation->set_rules('noplate', 'Number Plate', '');
				   $this->form_validation->set_rules('containerno', 'Container No', '');
					  $this->form_validation->set_rules('vesselno', 'Vessel No', '');
					 $this->form_validation->set_rules('parktype', 'Department', 'callback_combo_check');
					 $this->form_validation->set_rules('intime', 'Designation', 'callback_combo_check');
					 $this->form_validation->set_rules('outtime', 'Hired Date', '');
					 $this->form_validation->set_rules('hours', 'Hours', '');
					 $this->form_validation->set_rules('charges', 'Charges', 'numeric');

					 if ($this->form_validation->run() == FALSE)
					 {
						 //fail validation
						 //$this->load->view('employee_view', $data);
						 $this->mViewFile = 'updatetemp';
						 $this->mViewData = $data;
					 }
					 else
					 {


/*******edited for mangesh************/

$datetime = $this->input->post('outtime');

	$data['slab'] = $this->employee_model->get_slab_record();
	$result_d = $data['slab'];

$current_time = date('H:i',strtotime($datetime));

 foreach($result_d as $result){

	$from_time = $result->frmhrs;
	$to_time = $result->tohrs;

	if( ($from_time < $to_time) and ($current_time > $from_time and $current_time < $to_time) ){
			$slab = $result->id;
	}else if( ($from_time > $to_time) and ($current_time < $from_time and $current_time  < $to_time) ){
			$slab = $result->id;
	}
	else if( ($from_time > $to_time) and ($current_time > $from_time and $current_time  > $to_time) ){
			$slab = $result->id;
	}
}//echo $slab;

//$this->test();

/*************/
						 //pass validation
						 $data = array(
							 'pid' => $this->input->post('pid'),
							 'typeid' => $dd->typeid,
							 'noplate' => strtoupper(preg_replace('/\s+/', '',$this->input->post('noplate'))),
							 'containerno' => strtoupper(preg_replace('/\s+/', '',$this->input->post('containerno'))),
							 'vesselno' => strtoupper(preg_replace('/\s+/', '',$this->input->post('vesselno'))),
							 'intime' => $this->input->post('intime'),
							 'outtime' => $this->input->post('outtime'),
							 'hours' => $this->input->post('hours'),
							 'charges' => $this->input->post('charges'),
								'slab_status' => $dd->slab_status,
							 'slab_out' => $slab,
							 'status' => '1',
						 );

							 $receipt = $this->input->post('pid');
							 $parktype = $dd->typeid;
							 $noplate = strtoupper(preg_replace('/\s+/', '',$this->input->post('noplate')));
							 $containerno = $this->input->post('containerno');
							 $vesselno = $this->input->post('vesselno');
							 $invoiceno = $this->input->post('invoiceno');
							 $intime = $this->input->post('intime');
							 $outtime = $this->input->post('outtime');
							 $hours = $this->input->post('hours');
							 $charges = $this->input->post('charges');

						 $res['parktype'] = $this->employee_model->get_park_type($parktype);
						 $pdata = $res['parktype'][0];
						 //print_r($pdata);
						 $pname = $pdata->name;

						if($this->input->post('hdnAction')){
							if($this->input->post('hdnAction') == "In Print"){
								$this->inprint($receipt,$pname,$noplate,$containerno,$invoiceno,$intime);
								redirect('account/updateEmployee/'.$receipt);
							}elseif($this->input->post('hdnAction') == "Out Print"){
								$this->outprint($receipt,$pname,$noplate,$containerno,$invoiceno,$intime,$outtime,$hours,$charges);
								redirect('account/updateEmployee/'.$receipt);
							}
						}else{

							$this->outprint($receipt,$pname,$noplate,$containerno,$vesselno,$invoiceno,$intime,$outtime,$hours,$charges);
							 //update employee record
							 $this->db->where('pid', $empno);
							 $this->db->update('park', $data);

							 //display success message
							 $this->session->set_flashdata('msg', '<div class="alert alert-success text-center">Employee Record is Successfully Updated!</div>');
							 redirect('account/cg');
						  }

						 }

						 //custom validation function for dropdown input
						 function combo_check($str)
						 {
							 if ($str == '-SELECT-')
							 {
								 $this->form_validation->set_message('combo_check', 'Valid %s Name is required');
								 return FALSE;
							 }
							 else
							 {
								 return TRUE;
							 }
						 }

						 //custom validation function to accept only alpha and space input
						 function alpha_only_space($str)
						 {
								 if (!preg_match("/^([-a-z ])+$/i", $str))
								 {
									 $this->form_validation->set_message('alpha_only_space', 'The %s field must contain only alphabets or spaces');
									 return FALSE;
								 }
								 else
								 {
									 return TRUE;
								 }
							 }


	 }

///////////////////////////////
public function insertdata()
{

// redirect to Login page if user not logged in
		$this->mUser = get_user();
		if ( empty($this->mUser) )
		{
			redirect('account/');
			exit;
		}

		$this->load->model('employee_model');
		//fetch data from department and designation tables
		$data['parktype'] = $this->employee_model->get_department();
		$data['maxid'] = $this->employee_model->get_maxid();
		//set validation rules
		$this->form_validation->set_rules('pid', 'Id', 'trim|numeric');
		$this->form_validation->set_rules('noplate', 'Number Plate', '');
		$this->form_validation->set_rules('parktype', 'Department','callback_combo_check');
		$this->form_validation->set_rules('containerno', 'Container No', '');
		$this->form_validation->set_rules('vesselno', 'Vessel No', '');
		$this->form_validation->set_rules('invoiceno', 'Invoice No', '');
		$this->form_validation->set_rules('intime', 'Designation', 'callback_combo_check');
		$this->form_validation->set_rules('outtime', 'Hired Date', '');
		$this->form_validation->set_rules('hours', 'Hours', '');
		$this->form_validation->set_rules('charges', 'Charges', 'numeric');

		if ($this->form_validation->run() == FALSE)
		{
				//$this->mViewFile = 'employee_view';
				$this->mViewFile = 'temp';
				$this->mViewData = $data;

		}
		else
		{
				$datetime = $this->input->post('intime');
				#$datetime = ('2015-09-01 01:10:00');
				$a = date('H',strtotime($datetime));
				$b = date('i',strtotime($datetime));

				$c =$a.'.'.$b;
				$d_float = (float)$c;
				$d = ceil($d_float);


/****** edited for *mangesh************/

	$data['slab'] = $this->employee_model->get_slab_record();
	$result_d = $data['slab'];

$current_time = date('H:i',strtotime($datetime));

 foreach($result_d as $result){

	$from_time = $result->frmhrs;
	$to_time = $result->tohrs;

	if( ($from_time < $to_time) and ($current_time > $from_time and $current_time  < $to_time) ){
			$slab = $result->id;
	}else if( ($from_time > $to_time) and ($current_time < $from_time and $current_time  < $to_time) ){
			$slab = $result->id;
	}
	else if( ($from_time > $to_time) and ($current_time > $from_time and $current_time  > $to_time) ){
			$slab = $result->id;
	}

}//echo $slab;

//$this->test();

/*************/

/*******mangesh************/
/*

	$data['slab'] = $this->employee_model->get_slab_record();
	$result_d = $data['slab'];

$current_time = date('H:i',strtotime($datetime));

 foreach($result_d as $result){

	$from_time = $result->frmhrs;
	$to_time = $result->tohrs;

	if( ($from_time < $to_time) and ($current_time > $from_time and $current_time  < $to_time) ){
			$slab = $result->id;
	}
	else if( ($from_time > $to_time) and ($current_time > $from_time and $current_time  > $to_time) ){
			$slab = $result->id;
	}
}//echo $slab;

//$this->test();
*/

/*************/
				//pass validation
				$data = array(
						'pid' => $this->input->post('pid'),
						'typeid' => $this->input->post('parktype'),
						'noplate' => strtoupper(preg_replace('/\s+/', '',$this->input->post('noplate'))),
						'containerno' => $this->input->post('containerno'),
						'vesselno' => $this->input->post('vesselno'),
						'invoiceno' => $this->input->post('invoiceno'),
						'intime' => $this->input->post('intime'),
						'slab_status' => $slab,
				);

				$this->db->db_debug = FALSE;
				//insert the form data into database
				$this->db->insert('park', $data);
				if($this->db->_error_number()==1062){
	    					//redirect('account/');
							$pid = $this->employee_model->get_maxid();
							$data['pid'] = $pid;
							$this->db->insert('park', $data);
					}


						$receipt =  $data['pid'];
						$noplate = strtoupper(preg_replace('/\s+/', '',$this->input->post('noplate')));
						$parktype  = $this->input->post('parktype');
						$containerno =  $this->input->post('containerno');
						$vesselno=$this->input->post('vesselno');
						$invoiceno =  $this->input->post('invoiceno');
						$intime = $this->input->post('intime');

						$res['parktype'] = $this->employee_model->get_park_type($parktype);
						 $pdata = $res['parktype'][0];
						 //print_r($pdata);
						 $pname = $pdata->name;
				 	$this->inprint($receipt,$pname,$noplate,$containerno,$vesselno,$invoiceno,$intime);

				//display success message
				$this->session->set_flashdata('msg', '<div class="alert alert-success text-center">Employee details added to Database!!!</div>');
					redirect('account/insertdata');
		}



//custom validation function for dropdown input
function combo_check($str)
{
		if ($str == '-SELECT-')
		{
				$this->form_validation->set_message('combo_check', 'Valid %s Name is required');
				return FALSE;
		}
		else
		{
				return TRUE;
		}
}


//custom validation function to accept only alpha and space input
function alpha_only_space($str)
{
		if (!preg_match("/^([-a-z ])+$/i", $str))
		{
				$this->form_validation->set_message('alpha_only_space', 'The %s field must contain only alphabets or spaces');
				return FALSE;
		}
		else
		{
				return TRUE;
		}
}

}

///////////////////////////////////
function inprint($receipt,$parktype,$noplate,$containerno,$invoiceno,$intime) {

require_once("assets/escpos-php/Escpos.php");
try {
    // Enter the share name for your USB printer here
    $connector = new WindowsPrintConnector("epson");

    $printer = new Escpos($connector);


/* Print top logo */
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

function outprint($receipt,$pname,$noplate,$containerno,$invoiceno,$intime,$outtime,$hours,$charges) {
require_once("assets/escpos-php/Escpos.php");
try {
    // Enter the share name for your USB printer here
    $connector = new WindowsPrintConnector("epson");

    $printer = new Escpos($connector);
/* Print top logo */
$printer -> setJustification(Escpos::JUSTIFY_CENTER);

/* Name of shop */
$printer -> selectPrintMode(Escpos::MODE_DOUBLE_WIDTH);
$printer -> text("BILL/OUTPASS \n");
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
$printer -> text("RECEIPT NO :".$receipt."\n");
$printer -> feed();
$printer -> setTextSize(2,1);
$printer -> text("V. TYPE    :".$pname."\n");
$printer -> setTextSize(2,2);
$printer -> text("V.NO       :".$noplate."\n");
$printer -> feed();
$printer -> setTextSize(2,1);
/*$printer -> text("IN DT:".date('d/m/y',strtotime($intime))."TM:".date('h:i:s',strtotime($intime))."\n");*/
$printer -> text("IN  :".date('Y-m-d',strtotime($intime))." ".date('h:i:s',strtotime($intime))."\n");
$printer -> text("OUT :".date('Y-m-d',strtotime($outtime))." ".date('h:i:s',strtotime($outtime))."\n");
$printer -> feed();
$printer -> text("DURATION : ".$hours."\n");
$printer -> setTextSize(2,2);
$printer -> feed();
$printer -> text("AMOUNT   : ".$charges);
$printer -> setTextSize(1,1);

$printer -> setEmphasis(false);

$printer -> setEmphasis(true);
$printer -> setEmphasis(false);
$printer -> feed();

/* Tax and total */

/* Footer */
$printer -> feed(1);
$printer -> setJustification(Escpos::JUSTIFY_CENTER);
$printer -> text("THANK YOU! VISIT AGAIN!\n");
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

/////////////////////////////////////
	public function parklist()
	{
	 //load the department_model
	 $this->load->model('employee_model');
	 //call the model function to get the department data
	 $deptresult = $this->employee_model->get_park_list();
	 $data['deptlist'] = $deptresult;
	 //load the department_view

	 $this->mViewFile = 'department_view';
	 $this->mViewData = $data;
 }

public function getmaxid(){

	$data = array('id'=> $this->employee_model->get_maxid());
	$this->mViewFile = 'temp';

	echo json_encode($data);

}

public function getnoplate(){

    //$this->mViewFile = 'search1';
		 $this->load->model('employee_model');
  $search =  $this->input->post('noplate');
   $query = $this->employee_model->getNoplate($search);
	// echo '<pre>';
	// print_r($query->result());
	  $result = $query->result();

	 /*foreach ($result as $res) {

	 	$result[] = array("pid" => $res->pid ,"noplate"=> $res->noplate);
		//$this->db->update('park', $data);
}*/

echo json_encode($result);
 exit;

 }


public function ExportToExcel(){

            $this->load->library('Excel');
	         $data['rs'] =  $this->db->get('park');
           $this->load->view('search1', $data);

                 $this->excel->setActiveSheetIndex(0);
                 //name the worksheet
                 $this->excel->getActiveSheet()->setTitle('Park');
                 //set cell A1 content with some text
                 $this->excel->getActiveSheet()->setCellValue('A1', 'Park Excel Sheet');
                 $this->excel->getActiveSheet()->setCellValue('A4', 'Receipt No.');
                 $this->excel->getActiveSheet()->setCellValue('B4', 'Vehicle No');
                 $this->excel->getActiveSheet()->setCellValue('C4', 'Status');
								 $this->excel->getActiveSheet()->setCellValue('C4', 'Update');
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
                 //retrive park table data
                 $rs = $this->db->get('park');
                 $exceldata="";
         foreach ($rs->result_array() as $row){
                 $exceldata[] = $row;
         }
                 //Fill data
                 $this->excel->getActiveSheet()->fromArray($exceldata, null, 'A4');

                 $this->excel->getActiveSheet()->getStyle('A4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                 $this->excel->getActiveSheet()->getStyle('B4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                 $this->excel->getActiveSheet()->getStyle('C4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

                 $filename='ExportToExcel.xls'; //save our workbook as this file name
                 header('Content-Type: application/vnd.ms-excel'); //mime type
                 header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
                 header('Cache-Control: max-age=0'); //no cache

                 //save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
                 //if you want to save it as .XLSX Excel 2007 format
                 $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
                 //force user to download the Excel file without writing it to server's HD
                 $objWriter->save('php://output');

     }






 public function Get_All(){
$search =  $this->input->post('search');
$noplate =  $this->input->post('noplate');

$result['result']=$this->employee_model->get_data($search);



   echo json_encode($result);
       exit;


}


  public function getvesselname(){

    $search =  $this->input->post('search');

    $query = $this->employee_model->getVesselName($search);
    //print_r($query->result());
    $result = $query->result();
    //$aa=0;
    foreach ($result as $res) {

      $data[] = array("id" => $res->id ,"name"=> $res->vesselname);

    }

      echo json_encode($data);
    exit;

 }

	// Sign Up
	public function eg()
	{
		$this->load->model('Park_model', 'park');
		$this->mTitle = "Eg in controller";
		 //$my_data = $this->park->get_todos('1');
		 $data['maxid'] = $this->park->get_maxid();
//		print_r($my_data);

//$data['typename'] = $this->park->get_vehicle_type();
//		$this->load->view('account/park', $my_data);
		$this->mViewFile = 'account/park';
		$this->mViewData = $data['maxid'];
		//$this->mViewData = $data['typename'];

//		if ( validate_form() )
if($this->input->post())
		{
			$this->park->set_park(0);
			set_alert('success', 'Thanks for signing up! You will receive a email shortly to activate your account.');
			redirect('account/eg');

}
		//	$user_data = elements(['typeid','noplate','intime','outtime','hours','charges'], $this->input->post());
						// confirm to create use
			//$user_id = $this->aaa->insert($user_data);

		}



	public function cg()
	{

	// redirect to Login page if user not logged in
		$this->mUser = get_user();
		if ( empty($this->mUser) )
		{
			redirect('account/');
			exit;
		}

		$this->mTitle = "Eg in controller";
	 //$this->mViewFile = 'search';
   //	$this->mViewFile = 'tables';
		 $this->mViewFile = 'search1';

	}

	public function signup()
	{
		$this->mTitle = "Sign Up";
		$this->mViewFile = 'account/signup';

		if ( validate_form() )
		{
			$user_data = elements(['first_name', 'last_name', 'email', 'password'], $this->input->post());
			$user_data['password'] = hash_pw($user_data['password']);
			$user_data['activation_code'] = generate_unique_code();

			// confirm to create user
			$user_id = $this->users->insert($user_data);

			if ( !empty($user_id) )
			{
				// get newly created user (with activation code)
				$user = $this->users->get($user_id);

				// send activation email (make sure config/email.php is properly set first)
				/*
				$to_name = $user['first_name'].' '.$user['last_name'];
				$subject = 'Account Activation';
				send_email($user['email'], $to_name, $subject, 'signup', $user);
				*/

				// redirect with success message
				set_alert('success', 'Thanks for signing up! You will receive a email shortly to activate your account.');
				redirect('account/login');
			}

			// failed
			set_alert('danger', 'Failed to create user.');
			redirect('signup');
		}
	}

	// Login
	public function login()
	{
		$this->mTitle = "Login";
		$this->mViewFile = 'account/login';

		if ( validate_form() )
		{
			$email = $this->input->post('email');
			$password = $this->input->post('password');
			$user = $this->users->get_by([
				'email'		=> $email,
				'active'	=> 1
			]);

			if ( !empty($user) )
			{
				// "remember me"
				if ( $this->input->post('remember') )
				{
					$this->session->sess_expire_on_close = FALSE;
					$this->session->sess_update();
				}

				// check password
				if ( verify_pw($password, $user['password']) )
				{
					// limited fields to store in session
					$fields = array('id', 'role', 'first_name', 'last_name', 'email', 'created_at');
					$user_data = elements($fields, $user);
					login_user($user_data);

					// success
					set_alert('success', 'Login success.');
					redirect('home');
					exit;
				}
			}

			// failed
			$this->session->set_flashdata('form_fields', ['email' => $email]);
			set_alert('danger', 'Invalid Login.');
			redirect('account/login');
		}
	}

	// Account activation
	public function activate($code)
	{
		$user = $this->users->get_by([
			'activation_code' 	=> $code,
			'active'			=> 0
		]);

		// user found
		if ( !empty($user) )
		{
			// change user status
			$this->users->update($user['id'], ['active' => 1]);

			// (optional) send welcome email
			//$to_name = $user['first_name'].' '.$user['last_name'];
			//$subject = 'Welcome';
			//send_email($user['email'], $to_name, $subject, 'welcome', $user);

			// success
			set_alert('success', 'Account activated! Please login your account to continue.');
			redirect('account/login');
			exit;
		}

		// failed
		set_alert('danger', 'Invalid code.');
		redirect('account/login');
	}

	// Forgot Password
	public function forgot_password()
	{
		$this->mTitle = "Forgot Password";
		$this->mViewFile = 'account/forgot_password';
		$this->mViewData['alert'] = get_alert();

		if ( validate_form() )
		{
			$email = $this->input->post('email');
			$user = $this->users->get_by([
				'email'		=> $email,
				'active'	=> 1
			]);

			if ( !empty($user) )
			{
				// generate unique code
				$forgot_password_code = generate_unique_code();
				$this->users->update($user['id'], [
					'forgot_password_code'	=> $forgot_password_code,
					'forgot_password_time'	=> date('Y-m-d H:i:s')
				]);

				// send Reset Password email (make sure config/email.php is properly set first)
				/*
				$to_name = $user['first_name'].' '.$user['last_name'];
				$subject = 'Reset Password';
				$user['forgot_password_code'] = $forgot_password_code;
				send_email($user['email'], $to_name, $subject, 'reset_password', $user);
				*/

				// success
				set_alert('success', 'A email is sent to you to reset your password.');
				redirect('account/forgot_password');
				exit;
			}
			else
			{
				// failed
				set_alert('danger', 'No record found.');
				redirect('account/login');
			}
		}
	}

	// Reset Password
	public function reset_password($code)
	{
		$this->mTitle = "Reset Password";
		$this->mViewFile = 'account/reset_password';

		// TODO: check Forgot Password time
		$user = $this->users->get_by([
			'forgot_password_code' 	=> $code,
			'active'				=> 1
		]);

		// invalid Forgot Password code
		if ( empty($user) )
		{
			set_alert('danger', 'Invalid code.');
			redirect('account/login');
			exit;
		}

		// continue form validation
		if ( validate_form('', 'account/reset_password') )
		{
			// change user password
			$password = $this->input->post('password');
			$this->users->update($user['id'], [
				'forgot_password_code'	=> '',
				'forgot_password_time'	=> '',
				'password'				=> hash_pw($password)
			]);

			// (optional) send Password Changed email
			//$to_name = $user['first_name'].' '.$user['last_name'];
			//$subject = 'Password Changed';
			//send_email($user['email'], $to_name, $subject, 'password_changed', $user);

			// success
			set_alert('success', 'Password successfully changed! Please login your account with your new password.');
			redirect('account/login');
		}
	}

	// Update Info (submission from Account Settings page)
	public function update_info()
	{
		if ( validate_form('account') )
		{
			// check POST data
			$update_data = elements(['first_name', 'last_name', 'email'], $this->input->post());

			// check if email is unique (except the login user him/herself)
			$user = $this->users->get_by(['email' => $update_data['email']]);
			if ( !empty($user) && $user['id']!=$this->mUser['id'] )
			{
				set_alert('danger', 'The Email is taken by another user.');
				redirect('account');
				exit;
			}

			// confirm to update account info
			$success = $this->users->update($this->mUser['id'], $update_data);
			if ($success)
			{
				set_alert('success', 'Successfully updated.');
				refresh_user($update_data);
			}
			else
			{
				set_alert('danger', 'Database error.');
			}
		}

		redirect('account');
	}

	// Change Password (submission from Account Settings page)
	public function change_password()
	{
		if ( validate_form('account') )
		{
			// check if current password match the record
			$user = $this->users->get($this->mUser['id']);
			$current_password = $this->input->post('current_password');

			if ( verify_pw($current_password, $user['password']) )
			{
				// change user password
				$new_password = $this->input->post('new_password');
				$success = $this->users->update($this->mUser['id'], ['password' => hash_pw($new_password)]);

				// (optional) send Password Changed email
				//$to_name = $user['first_name'].' '.$user['last_name'];
				//$subject = 'Password Changed';
				//send_email($user['email'], $to_name, $subject, 'password_changed', $user);

				if ($success)
					set_alert('success', 'Password changed successfully.');
				else
					set_alert('danger', 'Database error.');
			}
			else
			{
				set_alert('danger', 'Incorrect current password.');
			}
		}

		redirect('account');
	}

	// Logout
	public function logout()
	{
		logout_user();
		set_alert('success', 'Successfully logout.');
		redirect('account/login');
		exit;
	}
}
