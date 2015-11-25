<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Plaza extends MY_Controller {

	public function index()
	{
		// CRUD table
		$this->load->helper('crud');
		$crud = generate_crud('plaza');
		$crud->unset_fields('');
		$crud->columns('vehicle_total','slot');

		$crud->display_as('Total Vehicle','Slot');
    		
		$this->mTitle = "Plaza Master";
   		$this->mViewFile = '_partial/crud';
		$this->mViewData['crud_data'] = $crud->render();
	}

	public function generateSlot(){

		//$this->load->model('slot_master');

		$n = 600;
		$t = 600/10;

		for($i = 0;$i< $n;$i =$i+10){
		        $from = $i+1;
		        $to = $i +10;

						$data = array(
								'name' => $from.' To '.$to,
								'from' => $from,
								'to' => $to,
						);

						$this->db->insert('slot_master', $data);
		        
		}

		exit;
	}

	public function getSlotDetails(){
		$this->load->model('slot_model');
		$slot_result = $this->slot_model->get_yard_slots();
		
		$slot_id = array();
		foreach ($slot_result as $value) {

				array_push($slot_id,$value->slot_id);
			$slots[] = $value->slot_id;
		}
		//$booked['booked']  = array(49,9,39,40);
		for( $i =0; $i < count( $slots ); $i++ ){   $slot_array[$i] = (int) $slots[$i];}

		$booked['booked'] = $slot_array;

		echo json_encode($booked);
		exit;
		
	}
	public function getSlotName(){
		$this->load->model('slot_model');
		$result = $this->slot_model->get_slots();
		
		echo json_encode($result);
		exit;
		
	}
	
	public function getYardSlotDetails(){
		$this->load->model('slot_model');
		$id = $this->input->post('yard_id');
		$vid = $this->input->post('vessel_id');
		
		$slot_result = $this->slot_model->get_yard_assigned_slots($id);
		$vessel_slot_result = $this->slot_model->get_yard_vessel_assigned_slots($id);
		$yard_vessel_slot_result = $this->slot_model->get_yard_vessel_booked_slots($id,$vid);

		foreach ($vessel_slot_result as $value) {
			
			$v_slots[] = $value->slot_id;
		}
		//$booked['booked']  = array(49,9,39,40);
		for( $i =0; $i < count( $v_slots ); $i++ ){   $v_slot_array[$i] = (int) $v_slots[$i];}

		
		foreach ($slot_result as $value) {
			if(!in_array($value->slot_id, $v_slot_array)){
			$slots[] = $value->slot_id;
			}
		}
		//$booked['booked']  = array(49,9,39,40);
		for( $i =0; $i < count( $slots ); $i++ ){   $slot_array[$i] = (int) $slots[$i];}

		foreach ($yard_vessel_slot_result as $value) {
			
			$yard_vessel_slot[] = $value->slot_id;
		}
		
		
			/******** * * */
			foreach ($vessel_slot_result as $value) {
					if(!in_array($value->slot_id, $yard_vessel_slot)){
						$v_slots_v[] = $value->slot_id;
					}else{
						$yard_vessel_slots[] = $value->slot_id;
					}
			}
			for( $i =0; $i < count( $v_slots_v ); $i++ ){   $v_slot_v_array[$i] = (int) $v_slots_v[$i];}
				for( $i =0; $i < count( $yard_vessel_slots ); $i++ ){   $yard_vessel_slots_array[$i] = (int) $yard_vessel_slots[$i];}

				$booked['newbooked'] = $v_slot_v_array;
				$booked['vesseled'] = $yard_vessel_slots_array;
			/**************/
		$booked['assigned'] = $slot_array;
		$booked['booked'] = $v_slot_array;
		echo json_encode($booked);
		exit;
		
	}


public function getYardSlotDetailsByYard(){
		$this->load->model('slot_model');
		$id = $this->input->post('yard_id');
		$slot_result = $this->slot_model->get_yard_assigned_slots($id);
		$full_slot_result = $this->slot_model->get_yard_slots();

		foreach ($slot_result as $value) {
			
			$slots[] = $value->slot_id;
		}

		foreach ($full_slot_result as $value) {
			if(!in_array($value->slot_id, $slots)){
			$full_slots[] = $value->slot_id;
			}
		}

		for( $i =0; $i < count( $slots ); $i++ ){   $slot_array[$i] = (int) $slots[$i];}
		for( $i =0; $i < count( $full_slots ); $i++ ){   $f_slot_array[$i] = (int) $full_slots[$i];}

		$booked['booked'] = $slot_array;
		$booked['total'] = $f_slot_array;
		
		echo json_encode($booked);
		exit;
		
	}

public function getYardSlotDetailsReallocate(){
	
		$this->load->model('slot_model');
		$id = $this->input->post('yard_id');
		$vid = $this->input->post('vessel_id');
		

		$yard_assigned = $this->slot_model->get_yard_assigned_slots($id);
		$vessel_assigned = $this->slot_model->get_yard_vessel_booked_slots($id,$vid);
		$other_vessel_assigned = $this->slot_model->get_yard_vessel_assigned_slots($id);
		$full_slots = $this->slot_model->get_vehicle_slots_reallocate($id);


		foreach ($full_slots as $value) {
			$full_slots_a[] = $value->slotno;
		}
		foreach ($vessel_assigned as $value) {
			$vessel_assigned_a[] = $value->slot_id;
		}
		foreach ($other_vessel_assigned as $value) {
			$other_vessel_assigned_a[] = $value->slot_id;
		}
		
		foreach ($yard_assigned as $value) {
			
			if(!in_array($value->slot_id, $vessel_assigned_a)){
				if(!in_array($value->slot_id, $other_vessel_assigned_a)){
					$yard_assigned_array[] = $value->slot_id;
				}if(in_array($value->slot_id, $full_slots_a)){
					$full_slots_array[] = $value->slot_id;
				}else{
					$other_vessel_assigned_array[] = $value->slot_id;
				}
			}else{
				if(!in_array($value->slot_id, $full_slots_a)){
					$vessel_assigned_array[] = $value->slot_id;
				}else{
					$full_slots_array[] = $value->slot_id;
				}
			}
		}

		for( $i =0; $i < count($yard_assigned_array); $i++ ){   $yard_assigned_array_n[$i] = (int) $yard_assigned_array[$i];}
		for( $i =0; $i < count($vessel_assigned_array); $i++ ){   $vessel_assigned_array_n[$i] = (int) $vessel_assigned_array[$i];}
		for( $i =0; $i < count($other_vessel_assigned_array); $i++ ){   $other_vessel_assigned_array_n[$i] = (int) $other_vessel_assigned_array[$i];}
		for( $i =0; $i < count($full_slots_array); $i++ ){   $full_slots_array_n[$i] = (int) $full_slots_array[$i];}

		$booked['assigned'] = $yard_assigned_array_n;
		$booked['v_assigned'] = $vessel_assigned_array_n;
		$booked['o_assigned'] = $other_vessel_assigned_array_n;
		$booked['full_assigned'] = $full_slots_array_n;
		echo json_encode($booked);
		exit;	
	}


	public function getVesselSlotDetails(){
		$this->load->model('slot_model');
		$id = $this->input->post('vessel_id');
		$slot_result = $this->slot_model->get_vessel_assigned_slots($id);
		//$full_slot_result = $this->slot_model->get_vehicle_alloted_slots($id);
		
		foreach ($slot_result as $value) {

						$full_slot_result = $this->slot_model->get_vehicle_alloted_slots($id,$value->slot_id);
						if(count($full_slot_result) == 10){
							$full_slots[] = $value->slot_id;
						}
						$slots[] = $value->slot_id;
						$total[] = count($full_slot_result);
		}
		
		foreach ($slots as $value) {
			if(!in_array($value, $full_slots)){
				$slots_s[] = $value;
			}
		}
		
		for( $i =0; $i < count($slots_s); $i++ ){   $slot_array[$i] = (int) $slots_s[$i];}
		for( $i =0; $i < count($full_slots); $i++ ){   $f_slot_array[$i] = (int) $full_slots[$i];}
		 for( $i =0; $i < count($total); $i++ ){   $t_total[$i] = (int) $total[$i];}

		$booked['booked'] = $slot_array;
		$booked['total'] = $t_total;
		$booked['packed'] = $f_slot_array;
		echo json_encode($booked);
		exit;
		
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
