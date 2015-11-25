<?php

/**
 * https://github.com/jamierumbelow/codeigniter-base-model
 */
class Dashboard_model extends MY_Model
{

	function get_plaza_slots()
    {
        $this->db->select('*');
        $this->db->from('slot_master');
        $query = $this->db->get();
        $result = $query->result();
   
        return $result;
    }
	
    function get_yard_vessels($id)
    {
        $this->db->select('v.*,count(yvm.slot_id) as v_count,yvm.slot_id');
        $this->db->from('yard_vessel_master as yvm');
        $this->db->join('vessel as v','v.id = yvm.vessel_id');
        $this->db->where('yvm.yard_id',$id);
        $this->db->group_by('yvm.vessel_id');
        $query = $this->db->get();
        $result = $query->result();
   
        return $result;
    }

	function get_yards()
    {
   
        $sql = "select y.*,(select count(p.pid) from park p where p.yardno = y.id and p.status = 0) as total from yard y";
        $query = $this->db->query($sql);
        $result = $query->result();
   
        return $result;
    }

    function get_vessels()
    {   
        $sql = "select v.*,(select count(p.pid) from park p where p.vesselno = v.id and p.status = 0) as total from vessel v";
        $query = $this->db->query($sql);
        $result = $query->result();
   
        return $result;
    }

}

?>