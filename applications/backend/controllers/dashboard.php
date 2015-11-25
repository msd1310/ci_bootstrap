<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends MY_Controller {

	public function index()
	{
		// CRUD table
		$this->load->helper('crud');
		$crud = generate_crud('plaza');
		$crud->unset_fields('');
		$crud->columns('vehicle_total','slot');

		$crud->display_as('Total Vehicle','Slot');

    	$this->load->model('slot_model');    	
    	$this->load->model('dashboard_model');
		$this->mTitle = "Dashboard";
   		$this->mViewFile = 'dashboard_view';
		//$this->mViewData['crud_data'] = $crud->render();
   		$plaza_slots = $this->dashboard_model->get_plaza_slots();
   		foreach ($plaza_slots as  $value) {
   			$slots_id[] = $value->id;
   		}
   		$yard = $this->dashboard_model->get_yards();

  		$this->mViewData['plaza_slots'] = $this->slot_model->get_slots();
   		$this->mViewData['yard'] = $yard;
   		$this->mViewData['vessel'] = $this->dashboard_model->get_vessels();

	}

	
}
