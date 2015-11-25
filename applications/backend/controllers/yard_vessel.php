<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Yard_vessel extends MY_Controller {


	public function __construct()
	{
		parent::__construct();
		$this->load->library('session');
		$this->load->helper('form');
		$this->load->helper('url');
		$this->load->database();
		$this->load->library('form_validation');
		$this->load->model('yard_vessel_model');
	}


	public function index()
	{
		
		$this->load->helper('crud');
		$crud = generate_crud('yard_vessel');
		$crud->unset_fields('');
		$crud->columns('name');
		$crud->callback_before_insert(array($this, 'callback_before_create_user'));

		$this->mTitle = "Yard Vessel Master";
		$this->mViewFile = 'yard_vessel_crud';
		$this->mViewData['yard'] = $this->yard_vessel_model->get_yard();
		$this->mViewData['record'] = $this->yard_vessel_model->get_yard_record();
		
				$this->form_validation->set_rules('yard_id', 'Select Yard', '');
				$this->form_validation->set_rules('vessel', 'Select Vessel', '');
				$this->form_validation->set_rules('alloted_slots', 'Alloted Slots', '');

				if ($this->form_validation->run() == FALSE)
				{
						//$this->mViewFile = 'employee_view';
						$this->mViewFile = 'yard_vessel_crud';
						$this->mViewData['yard'] = $this->yard_vessel_model->get_yard();
				}
				else
				{
					/*$yard_slot = $this->yard_vessel_model->get_yard_slot($this->input->post('yard_id'));
					$alloted_slot = $this->yard_vessel_model->get_yard_alloted_slot($this->input->post('yard_id'));
					foreach ($yard_slot as $yard_slot) {
						# code...
						$total_slot = $yard_slot->quantity;
					}
					$t_alloted_slots = 0;
					foreach ($alloted_slot as $value) {
						# code...
						$alloted_slots = $value->alloted_slot;
						$t_alloted_slots = $t_alloted_slots + $alloted_slots;
					}
					$remains = $total_slot - $t_alloted_slots;*/

						$data = array(
								'yard_id' => $this->input->post('yard_id'),
								'vessel_id' => $this->input->post('vessel_hidden'),
								'alloted_slot' => $this->input->post('alloted_slot'),
						);

						$this->session->set_flashdata('msg', '<div class="alert alert-success text-center">Record Saved!</div>');

						$this->db->insert('yard_vessel', $data);
						redirect('yard_vessel/');
				}
		
		
	}
	

	public function getYardSlot(){

		$id = $this->input->post('search');
		$yard_slot = $this->yard_vessel_model->get_yard_slot($id);
		$alloted_slot = $this->yard_vessel_model->get_yard_alloted_slot($id);
		foreach ($yard_slot as $yard_slot) {
			# code...
			$total_slot = $yard_slot->quantity;
		}
		$t_alloted_slots = 0;
		foreach ($alloted_slot as $value) {
			# code...
			$alloted_slots = $value->alloted_slot;
			$t_alloted_slots = $t_alloted_slots + $alloted_slots;
		}
		
		$data['total_slot'] = $total_slot;
		$data['alloted_slot'] = $t_alloted_slots;
		$data['remaining_slot'] = $total_slot - $t_alloted_slots;

		echo json_encode($data);
		exit;
	}
	
	public function getYardVesselSlot(){

		$vid = $this->input->post('vessel');
		$yid = $this->input->post('yard');
		$yard_vessel_slot = $this->yard_vessel_model->get_yard_vessel_slot($vid,$yid);
		$alloted_slot = $this->yard_vessel_model->get_vessel_alloted_slot($vid,$yid);
		foreach ($yard_vessel_slot as $yard_vessel_slot) {
			# code...
			$total_slot = $yard_vessel_slot->alloted_slot;
		}
		$t_alloted_slots = count($alloted_slot);
		/*foreach ($alloted_slot as $value) {
			# code...
			$alloted_slots = $value->alloted_slot;
			$t_alloted_slots = $t_alloted_slots + $alloted_slots;
		}*/
		$data['total_slot'] = $total_slot;
		$data['alloted_slot'] = count($alloted_slot);//$t_alloted_slots;
		$data['remaining_slot'] = $total_slot - $t_alloted_slots;

		echo json_encode($data);
		exit;
	}

public function getVesselSlot(){

		$id = $this->input->post('search');
		
		$vessel_slot = $this->yard_vessel_model->get_vessel_total_slot($id);
		$alloted_slot = $this->yard_vessel_model->get_vessel_alloted_slot($id);

		foreach ($yard_slot as $yard_slot) {
			# code...
			$total_slot = $yard_slot->quantity;
		}
		$t_alloted_slots = 0;
		foreach ($alloted_slot as $value) {
			# code...
			$alloted_slots = $value->alloted_slot;
			$t_alloted_slots = $t_alloted_slots + $alloted_slots;
		}
		
		$data['total_slot'] = $total_slot;
		$data['alloted_slot'] = $t_alloted_slots;
		$data['remaining_slot'] = $total_slot - $t_alloted_slots;

		echo json_encode($data);
		exit;
}
public function getYardListByVessel(){

	$vid = $this->input->post('search');
	$data['yard'] = $this->yard_vessel_model->get_yard_vessel_list($vid);
	echo json_encode($data['yard']);
	
	exit;
}

public function delete($id)
{
	echo $id;
	$this->yard_vessel_model->delete_yard_vessel_id($id);
	//$this->db->delete('yard_vessel', array('id' => $id)); 
	//$this->mViewFile = 'yard_vessel_crud';
	$this->session->set_flashdata('msg', '<div class="alert alert-success text-center">Record Deleted!</div>');
	redirect('yard_vessel/');
}

public function reallocate(){

	$sql_yard = "select yard_vessel.*,vessel_name,yard_name from yard_vessel
				join yard on yard.id = yard_vessel.yard_id
				join vessel on vessel.id = yard_vessel.vessel_id
				";
    $query_yard = $this->db->query($sql_yard);
    $this->mViewFile = 'reallocate_vessel';
    $this->mViewData['query_yard'] = $query_yard;
    $data = array();
    foreach ($query_yard->result_array() as $res) {
    	# code...
   		$vid = $res['vessel_id']; $yid = $res['yard_id'];

    	$sql = "select count(*) as total from park where vesselno = '{$vid}' and yardno = '{$yid}' and status=0";
    	$query = $this->db->query($sql);
    	$dd = $query->result();
    	$total = $dd[0]->total;

    	$vname = $res['vessel_name'];
    	$yname = $res['yard_name'];
    	$allotedslot = $res['alloted_slot'];


    	$data_res = array('vname'=>$vname,'yname'=>$yname,'allotedslot'=>$allotedslot,'vid'=>$vid,'yid'=>$yid,'total'=>$total);
    	array_push($data,$data_res);
    }
   //print_r($data);
    $this->mViewData['result'] = $data;
}

public function edit($id)
{
	//echo $id;
	
	$this->mViewData['yard'] = $this->yard_vessel_model->get_yard();
	//$this->db->delete('yard_vessel', array('id' => $id)); 
	$this->mViewData['result'] = $this->yard_vessel_model->get_yard_record_id($id);
	$this->mViewFile = 'yard_vessel_crud_edit';		

				$this->form_validation->set_rules('yard_id', 'Select Yard', '');
				$this->form_validation->set_rules('vessel', 'Select Vessel', '');
				$this->form_validation->set_rules('alloted_slot', 'Alloted Slots', '');

			if($this->input->post()){
				if ($this->form_validation->run() == FALSE)
				{
						//$this->mViewFile = 'employee_view';
						echo "if";
						$this->mViewFile = 'yard_vessel_crud_edit';
						$this->mViewData['result'] = $this->yard_vessel_model->get_yard_record_id($id);
				}
				else
				{
						$data = array(
								'yard_id' => $this->input->post('yard_id'),
								'vessel_id' => $this->input->post('vessel_hidden'),
								'alloted_slot' => $this->input->post('alloted_slot'),
						);

						//$this->db->insert('yard_vessel', $data);
						 $this->db->where('id', $id);
						 $this->db->update('yard_vessel', $data);
						redirect('yard_vessel/');
						$this->session->set_flashdata('msg', '<script type="text/javascript">alert("Successfully updated");</script>');
				}
			}
	//$this->session->set_flashdata('msg', '<div class="alert alert-success text-center">Record Deleted!</div>');
	//redirect('yard_vessel/');
}
 
}
