<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Yard_slot extends MY_Controller {


	public function __construct()
	{
		parent::__construct();
		$this->load->library('session');
		$this->load->helper('form');
		$this->load->helper('url');
		$this->load->database();
		$this->load->library('form_validation');
		$this->load->model('yard_vessel_model');
		$this->load->model('slot_model');
	}


	public function index()
	{
		
		$this->load->helper('crud');
		$crud = generate_crud('yard_slot'); 
		$crud->unset_fields('');
	

		$this->mTitle = "Yard Slot Master";
		$this->mViewFile = 'yard_slot_crud';
		$this->mViewData['yard'] = $this->yard_vessel_model->get_yard();
		$this->mViewData['slot'] = $this->slot_model->get_slots();	
		
				
	}

	public function reallocate()
	{
		
		$this->load->helper('crud');
		$crud = generate_crud('yard_slot'); 
		$crud->unset_fields('');
		
		/*$q = "select * from slot_master where id not in (select slotno from park )";
        $query = $this->db->query($q);
        $result = $query->result();
        print_r($result);*/

		$this->mTitle = "Yard Slot Master";
		$this->mViewFile = 'vessel_slot_reallocate';
		$this->mViewData['yard'] = $this->yard_vessel_model->get_yard();
		$this->mViewData['vessel'] = $this->slot_model->get_vessels();	
		$this->mViewData['slot'] = $this->slot_model->get_slots();
	}

	public function insertVessel()
	{
		
		$this->load->helper('crud');
		$crud = generate_crud('yard_slot'); 
		$crud->unset_fields('');
	

		$this->mTitle = "Yard Slot Master";
		$this->mViewFile = 'vessel_slot_crud';
		$this->mViewData['yard'] = $this->yard_vessel_model->get_yard();
		$this->mViewData['vessel'] = $this->slot_model->get_vessels();	
		$this->mViewData['slot'] = $this->slot_model->get_slots();
				
	}
	
	
	function saveYardSlot(){
		$yard = $this->input->post('yard_id');
		$slotArray = $this->input->post('slotArray');
		foreach ($slotArray as $value) {
			//echo $value;
						$data = array(
								'yard_id' => $yard,
								'slot_id' => $value,
						);

			$this->db->insert('yard_slot', $data);
		}
		echo json_encode($slotArray);
		exit;
	}

	function saveYardVesselSlot(){

		$yard = $this->input->post('yard_id');
		$vessel = $this->input->post('vessel_id');
		$slotArray = $this->input->post('slotArray');
		foreach ($slotArray as $value) {
			//echo $value;
						$data = array(
								'yard_id' => $yard,
								'vessel_id'=>$vessel,
								'slot_id' => $value,
						);

			$this->db->insert('yard_vessel_master', $data);
		}
			echo json_encode($slotArray);

		exit;
	}

	function updateYardVesselSlot(){

		$yard = $this->input->post('yard_id');
		$vessel = $this->input->post('vessel_id');
		$slotArray = $this->input->post('slotArray');

		foreach ($slotArray as $value) {
			//echo $value;
			$this->db->where('slot_id',$value);
			$this->db->where('yard_id',$yard);
   			$q = $this->db->get('yard_vessel_master');

   			if ($q->num_rows() > 0) {
   						$data = array(
								'vessel_id'=>$vessel,
						);
				
				$this->db->where('slot_id',$value);
			    $this->db->where('yard_id',$yard);
   				$this->db->update('yard_vessel_master', $data);
   				$var = "update";
   			}else{
   						$data = array(
								'yard_id' => $yard,
								'vessel_id'=>$vessel,
								'slot_id' => $value,
						);
				$this->db->insert('yard_vessel_master', $data);
				$var = "insert";
			}
		}
			echo json_encode($var);

		exit;
	}
 

 /******************************************************/
  public function drag_n_drop_slot(){

  	$this->load->helper('crud');
		$crud = generate_crud('yard_slot'); 
		$crud->unset_fields('');
	

		$this->mTitle = "Yard Slot Master";
		$this->mViewFile = 'dragndrop_slot_new';
		$this->mViewData['yard'] = $this->yard_vessel_model->get_yard_for_drag();
		$this->mViewData['slot'] = $this->slot_model->get_slots();	
  }
  
  public function updateDragList(){

  		$this->mViewFile = 'dragndrop_slot';
  }
}
