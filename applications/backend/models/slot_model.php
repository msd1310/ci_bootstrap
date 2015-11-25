<?php

/**
 * https://github.com/jamierumbelow/codeigniter-base-model
 */
class Slot_model extends MY_Model
{

	function get_yard_slots()
    {
        $this->db->select('*');
        $this->db->from('yard_slot');
        $query = $this->db->get();
        $result = $query->result();

        //array to store department id & department name
       $slot_id = array();
    
        return $result;
    }
    function get_yard_assigned_slots($id)
    {
        $this->db->select('*');
        $this->db->where('yard_id',$id);
        $this->db->from('yard_slot');

        $query = $this->db->get();
        $result = $query->result();

        //array to store department id & department name
       $slot_id = array();
    
        return $result;
    }

function get_yard_vessel_assigned_slots($id)
    {
        $this->db->select('*');
        $this->db->where('yard_id',$id);
        $this->db->from('yard_vessel_master');

        $query = $this->db->get();
        $result = $query->result();

        //array to store department id & department name
       $slot_id = array();
    
        return $result;
    }
   
    
    function get_vessel_assigned_slots($id)
    {
        $this->db->select('*');
        $this->db->where('vessel_id',$id);
        $this->db->from('yard_vessel_master');

        $query = $this->db->get();
        $result = $query->result();

        //array to store department id & department name
       $slot_id = array();
    
        return $result;
    }

    function get_slots()
    {
        $this->db->select('*');
        $this->db->from('slot_master');
        $query = $this->db->get();
        $result = $query->result();

       return $result;
    }

function get_vehicle_alloted_slots($vid,$sid)
    {
        $this->db->select('*');
        $this->db->where('vesselno',$vid);
        $this->db->where('slotno',$sid);
        $this->db->where('status',0);
        $this->db->from('park');
        $query = $this->db->get();
        $result = $query->result();

       return $result;
    }


function get_vehicle_slots_reallocate($yid)
    {
        $this->db->select('*');
        //$this->db->where('vesselno',$vid);
        $this->db->where('yardno',$yid);
        $this->db->where('status',0);
        $this->db->from('park');
        $query = $this->db->get();
        $result = $query->result();

       return $result;
    }


    function get_yard_vessel_booked_slots($yid,$vid)
    {
        $this->db->select('*');
        $this->db->where('yard_id',$yid);
        $this->db->where('vessel_id',$vid);
        $this->db->from('yard_vessel_master');
        $query = $this->db->get();
        $result = $query->result();

       return $result;
    }

function get_vessels()
    {
        $this->db->select('*');
        $this->db->from('vessel');
        $query = $this->db->get();
        $result = $query->result();


        $v_id = array('');
        $v_name = array('--select--');

        for ($i = 0; $i < count($result); $i++)
        {
            array_push($v_id, $result[$i]->id);
            array_push($v_name, $result[$i]->vessel_name);
        }
        return $department_result = array_combine($v_id, $v_name);
      
    }

}