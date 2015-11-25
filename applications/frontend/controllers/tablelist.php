<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

date_default_timezone_set("Asia/Kolkata");

class Tablelist extends MY_Controller {

 
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
  }

  public function index(){
    
    $this->mViewFile = 'sonali';
  }
  
  public function get_json_record(){

    $search =  $this->input->post('search');
    
    $query = $this->employee_model->getRecordList($search);
    
    $result = $query->result();
    //$aa=0;
    foreach ($result as $res) {

      $data[] = array("pid" => $res->pid ,"noplate"=> $res->noplate);
      /*$data['pid'] = $res->pid;
      $data['noplate'] = $res->noplate;*/
      
    }
   
    $this->mViewFile = 'sonali';
    //$this->mViewData['result'] = $data;
    echo json_encode($data);
    exit;
  
 } 
 
 public function ajaxcall(){

header('Content-Type: application/json');
$data['id']   = $this->input->post('search');
$data['name'] = 'Ziyed';
$data['age']  = '24';
$data['sex']  = 'Male';
$this->mViewFile = 'sonali';
echo json_encode($data);

}
}
?>