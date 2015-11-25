<?php

/**
 * https://github.com/jamierumbelow/codeigniter-base-model
 */
class Piechart_model extends MY_Model
{

	
	function get_yard_slots()
    {
        $sql = "select count(*) as count, y.id as y_id,y.yard_name,ys.* ,s.name from yard as y left join yard_slot as ys on y.id = ys.yard_id 
        left join slot_master as s on s.id = ys.slot_id group by y.id";
        //$sql = "select * from yard";
        $query = $this->db->query($sql);
        
        $result = $query->result();
	    return $result;
    }
	function get_yard_vessel_slots()
    {
        $sql = "";
        //$sql = "select * from yard";
        $query = $this->db->query($sql);
        
        $result = $query->result();
        return $result;
    }

}

?>