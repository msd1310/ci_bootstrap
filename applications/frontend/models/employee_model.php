<?php
/*
 * File Name: employee_model.php
 */
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class employee_model extends CI_Model
{
    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }

    var $table = 'park';

    function fetch_record($limit, $start)
    {
     $this->db->limit($limit, $start);
     $query = $this->db->get($this->table);
     return ($query->num_rows() > 0)  ? $query->result() : FALSE;

    }
var $table1 = 'slab';
    function record_count()
    {
         return $this->db->count_all($this->table1);
    }

    public function get_slab($timer) {
        $sql = 'select * from slab';
        $query = $this->db->query($sql);
        $result = $query->result();
        $t = $timer;
        foreach($result as $rr) {

          $from = $rr->frmhrs;
          $to = $rr->tohrs;
           $id = $rr->id;

               if($from < $t && $t < $to) {
                   return $id;
               }

       }
    }
 	function getRecordList($search){
		$this->db->select("*");
		//$whereCondition = array('noplate' =>$search);
		//$this->db->where($whereCondition);
		$this->db->from('park');
    $this->db->like('noplate',$search,'both');
		$query = $this->db->get();
//		return $query->result();
    return $query;
	}


  function getNoplate($search){

    $this->db->select("*");
    $this->db->from('park');
    $this->db->like('noplate',$search,'both');
    $query = $this->db->get();
    //    return $query->result();
    return $query;
  }

  function getVesselList($search){

    $this->db->select("*");
    $this->db->from('vessel');
    $this->db->like('vessel_name',$search,'both');
    $query = $this->db->get();
    //    return $query->result();
    return $query;
  }


  function getYardListByVessel($search){
		$this->db->select('yv.*,y.yard_name,y.id');
        $this->db->from('yard_vessel as yv');
        $this->db->join('yard as y', 'yv.yard_id = y.id');
        $this->db->where('yv.vessel_id',$search);
	    $query = $this->db->get();
//    return $query->result();
    return $query;
  }

    public function get_charges($slabid,$typeid) {

      $s = $slabid;
//      $sql = "select charges from charges where typeid='$typeid' && slabid='$slabid'";
      $sql = "select charges from charges where typeid='$typeid'";
      $query = $this->db->query($sql);
      $result = $query->result();
      return $result;
    }

    public function get_park_type($typeid) {

      $sql = "select name from parktype where id = '$typeid' ";
      $query = $this->db->query($sql);
      $result = $query->result();
      return $result;
    }

    public function get_vessel_name($id) {

      $sql = "select vessel_name from vessel where id = '$id' ";
      $query = $this->db->query($sql);
      $result = $query->result();
      return $result;
    }

	 public function get_yard_name($id) {

      $sql = "select yard_name from yard where id = '$id' ";
      $query = $this->db->query($sql);
      $result = $query->result();
      return $result;
    }
    public function get_maxid()
    {
      $sql = 'select max(pid) maxid from park';
      $query = $this->db->query($sql);
      $result = $query->result();
      foreach($result as $ar) {
      $data = $ar->maxid;
      if($data == 0) {
          return $data+1;
        }
      else {
        return $data+1;
        }

      }
    //                        return $query->result_array();


            return $query->row_array();
    }

    function get_park_list()
       {
            $sql = 'select noplate,intime,outtime,hours,charges,name from park, parktype where parktype.id = park.typeid';
            $query = $this->db->query($sql);
            $result = $query->result();
            return $result;
       }

    function get_park_record_json()
      {
	     $this->db->where('status', 0);
	     $this->db->from('park');
	     $query = $this->db->get();
     	     $result = $query->result();

		return $result;
      }

    function get_park_record($empno)
      {
     $this->db->where('pid', $empno);
     $this->db->from('park');
     $query = $this->db->get();
     return $query->result();
      }
    function get_slab_record()
      {
            $sql = 'select * from slab';
            $query = $this->db->query($sql);
            $result = $query->result();
            return $result;
      }

    //get department table to populate the department name dropdown
    function get_department()
    {
        $this->db->select('id');
        $this->db->select('name');
        $this->db->from('parktype');
        $query = $this->db->get();
        $result = $query->result();

        //array to store department id & department name
        $dept_id = array('');
        $dept_name = array('--select--');

        for ($i = 0; $i < count($result); $i++)
        {
            array_push($dept_id, $result[$i]->id);
            array_push($dept_name, $result[$i]->name);
        }
        return $department_result = array_combine($dept_id, $dept_name);
    }

    //get designation table to populate the designation dropdown
    function get_designation()
    {
        $this->db->select('designation_id');
        $this->db->select('designation_name');
        $this->db->from('tbl_designation');
        $query = $this->db->get();
        $result = $query->result();

        $designation_id = array('-SELECT-');
        $designation_name = array('-SELECT-');

        for ($i = 0; $i < count($result); $i++)
        {
            array_push($designation_id, $result[$i]->designation_id);
            array_push($designation_name, $result[$i]->designation_name);
        }
        return $designation_result = array_combine($designation_id, $designation_name);
    }



    /********************************************************************/

     function get_slots()
    {
        $this->db->select('*');
        $this->db->from('slot_master');
        $query = $this->db->get();
        $result = $query->result();

       return $result;
    }

    function get_yard_by_vessel_slot($sid)
    {
      /*  $this->db->select('*');
        $this->db->where('vessel_id',$vid);
        $this->db->where('slot_id',$sid);
        $this->db->from('yard_vessel_master');
        $query = $this->db->get();
        $result = $query->result();*/
         $this->db->select('*');
        $this->db->where('slot_id',$sid);
        $this->db->from('yard_vessel_master');
        $query = $this->db->get();
        $result = $query->result();

       return $result;
    }

    function get_yard_by_slotonly($sid)
    {
        $this->db->select('*');
        $this->db->where('slot_id',$sid);
        $this->db->from('yard_slot');
        $query = $this->db->get();
        $result = $query->result();

       return $result;
    }

     public function get_slot_name($id) {

      $sql = "select name from slot_master where id = '$id' ";
      $query = $this->db->query($sql);
      $result = $query->result();
      return $result;
    }

}
?>
