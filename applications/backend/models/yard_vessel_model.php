<?php

/**
 * https://github.com/jamierumbelow/codeigniter-base-model
 */
class Yard_vessel_model extends MY_Model
{

	function get_yard()
    {
        $this->db->select('id');
        $this->db->select('yard_name');
        $this->db->from('yard');
        $query = $this->db->get();
        $result = $query->result();

        //array to store department id & department name
        $dept_id = array('');
        $dept_name = array('--select--');

        for ($i = 0; $i < count($result); $i++)
        {
            array_push($dept_id, $result[$i]->id);
            array_push($dept_name, $result[$i]->yard_name);
        }
        return $department_result = array_combine($dept_id, $dept_name);
    }

    function get_yard_for_drag()
    {
        $this->db->select('id');
        $this->db->select('yard_name');
        $this->db->from('yard');
        $query = $this->db->get();
        $result = $query->result();

        return $query;
    }

function get_yard_vessel_list($vid)
    {
        $this->db->select('yv.*,y.yard_name,y.id');
        $this->db->from('yard_vessel');
        $this->db->join('yard as y', 'yv.yard_id = y.id');
        $this->db->where('yv.vessel_id',$vid);
        $query = $this->db->get();
        $result = $query->result();

        //array to store department id & department name
        $dept_id = array('');
        $dept_name = array('--select--');

        for ($i = 0; $i < count($result); $i++)
        {
            array_push($dept_id, $result[$i]->yard_id);
            array_push($dept_name, $result[$i]->yard_name);
        }
        return $department_result = array_combine($dept_id, $dept_name);
    }


    function get_yard_slot($id)
    {
        $this->db->select('*');
        $this->db->where('id',$id);
        $this->db->from('yard');
        $query = $this->db->get();
        $result = $query->result();
        return $result;

    }

    function get_yard_record()
    {
        $this->db->select('yv.*,y.yard_name,v.vessel_name');
        $this->db->from('yard_vessel as yv');
        $this->db->join('yard as y', 'yv.yard_id = y.id');
        $this->db->join('vessel as v', 'yv.vessel_id = v.id');
        $query = $this->db->get();
        $result = $query->result();
        return $result;

    }
    function get_yard_record_id($id)
    {
        $this->db->select('yv.*,y.yard_name,v.vessel_name');
        $this->db->from('yard_vessel as yv');
        $this->db->join('yard as y', 'yv.yard_id = y.id');
        $this->db->join('vessel as v', 'yv.vessel_id = v.id');
        $this->db->where('yv.id',$id);
        $query = $this->db->get();
        $result = $query->result();
        return $result;

    }

    function get_yard_alloted_slot($id)
    {
        $this->db->select('*');
        $this->db->where('yard_id',$id);
        $this->db->from('yard_vessel');

        $query = $this->db->get();
        $result = $query->result();
        return $result;

    }

    function get_vessel_total_slot($id)
    {
        $this->db->select('*');
        $this->db->where('vessel_id',$id);
        $this->db->from('yard_vessel');

        $query = $this->db->get();
        $result = $query->result();
        return $result;

    }
	function get_yard_vessel_slot($vid,$yid)
    {
        $this->db->select('*');
        $this->db->where('vessel_id',$vid);
		$this->db->where('yard_id',$yid);
        $this->db->from('yard_vessel');

        $query = $this->db->get();
        $result = $query->result();
        return $result;

    }
    function get_vessel_alloted_slot($vid,$yid)
    {
        $this->db->select('*');
        $this->db->where('vesselno',$vid);
		$this->db->where('yardno',$yid);
        $this->db->where('status',0);
        $this->db->from('park');

        $query = $this->db->get();
        $result = $query->result();
        return $result;

    }

    function delete_yard_vessel_id($id){
		$this->db->where('id', $id);
		$this->db->delete('yard_vessel');
	}
}