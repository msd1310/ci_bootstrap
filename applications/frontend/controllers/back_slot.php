<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Back_slot extends MY_Controller {

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

                $this->load->model('back_slot_model');
                $slot_result = $this->back_slot_model->get_yard_slots();
                //print_r($slot_result);
                $slot_id = array();
                foreach ($slot_result as $value) { 
                        $slot_result = $this->back_slot_model->get_full_slotsid_by_slot($value->slot_id);
                            
                            if($slot_result >= 1){
                                                array_push($slot_id,$value->slot_id);
                                                    $fullSlots[] = $value->slot_id;
                                                
                            }else{
                                                $slots[] = $value->slot_id;
                            }

                 }
                //$booked['booked']  = array(49,9,39,40);
                for( $i =0; $i < count( $slots ); $i++ ){   $slot_array[$i] = (int) $slots[$i];}
                    for( $i =0; $i < count( $fullSlots ); $i++ ){   $f_slot_array[$i] = (int) $fullSlots[$i];}

                $booked['booked'] = $slot_array;
                $booked['fulled'] = $f_slot_array;

                echo json_encode($booked);
                exit;
                
        }
        public function getSlotName(){
                $this->load->model('back_slot_model');
                $result = $this->back_slot_model->get_slots();
                
                echo json_encode($result);
                exit;
                
        }
        
        public function getYardSlotDetails(){
                $this->load->model('back_slot_model');
                $id = $this->input->post('yard_id');
                $slot_result = $this->back_slot_model->get_yard_assigned_slots($id);
                $vessel_slot_result = $this->back_slot_model->get_yard_vessel_assigned_slots($id);
                
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


                $booked['assigned'] = $slot_array;
                $booked['booked'] = $v_slot_array;
                echo json_encode($booked);
                exit;
                
        }




        public function getVesselSlotDetails(){
                $this->load->model('back_slot_model');
                $id = $this->input->post('vessel_id');
                $slot_result = $this->back_slot_model->get_vessel_assigned_slots($id);
                //$full_slot_result = $this->slot_model->get_vehicle_alloted_slots($id);
                
                foreach ($slot_result as $value) {

                                                $full_slot_result = $this->back_slot_model->get_vehicle_alloted_slots($id,$value->slot_id);
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
