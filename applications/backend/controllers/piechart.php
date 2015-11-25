<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

date_default_timezone_set("Asia/Kolkata");

class Piechart extends MY_Controller {

	function __Construct(){
 		 parent::__Construct ();
		   $this->load->database(); // load database
		   $this->load->model('piechart_model'); // load model
          $this->load->model('dashboard_model');
    }
    
    function index(){

        $this->mViewFile = 'piechart_view';
        $total_data = array();
        $data['yard'] = $this->piechart_model->get_yard_slots();
        //$data['vessel'] = $this->piechart_model->get_yard_vessel_slots();

        foreach ( $data['yard'] as $value) {
            unset($new_data);
            $new_data['y_name'] = $value->yard_name; $new_data['y_count'] = $value->count;
            $data['vessel'] = $this->dashboard_model->get_yard_vessels($value->yard_id);


            foreach ($data['vessel'] as $key => $value1) {
                
                $this->db->select('*');
                $this->db->from('slot_master');
                $this->db->where('id',$value1->slot_id);
                $query = $this->db->get();
                $result = $query->result();
                
                /*array_push($t_data,array(
                            'yard_name'=>$value->yard_name,
                            'yard_count'=>$value1->count,
                             'vessel_names' =>$value->vessel_name,
                                )
                    );   */
                //$d_array['vessels'][] = array('v_name'=>$value1->vessel_name,'v_count'=>$value1->v_count);
                    $new_data['vessels'][] = array('v_name'=>$value1->vessel_name,'v_count'=>$value1->v_count);
                }
            array_push($total_data,$new_data);
            
        }   
        
        print_r($total_data);

        $this->mViewData['yard'] = $data['yard'];
        $this->mViewData['vessel'] = $data['vessel'];
        $this->mViewData['total'] = $total_data;
    }
    function getVesselFromYard(){

        
        
        $search = $this->input->get('search');

        $vessel_result = $this->dashboard_model->get_yard_vessels($search);
        
        echo json_encode($vessel_result);
        exit;

    }
	
}
