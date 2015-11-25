<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends MY_Controller {

	public function index()
	{
		$this->mLayout = "home";
		$this->mTitle = "Home";
		$this->mViewFile = 'home';
	}

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



}
