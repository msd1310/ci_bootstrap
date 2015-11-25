<?php
ini_set('memory_limit', '1024M');
set_time_limit(0);
    class report_model extends MY_Model
    {

	function select_estimate_data($parktype,$fdate,$tdate,$stype)
        {
			
			
	  if($parktype != '' and $fdate != '' and $tdate != '' and $stype != ''){
		  
		$where_array = array('typeid'=>$parktype,'Date(intime) >=' => $fdate,'Date(intime) <=' => $tdate,'slab_status'=>$stype);
	  }elseif($parktype != '' and $fdate != '' and $tdate != '' and $stype == ''){
		$where_array = array('typeid'=>$parktype,'Date(intime) >=' => $fdate,'Date(intime) <=' => $tdate);	
	  }elseif($parktype != '' and $fdate == '' and $tdate == '' and $stype == ''){
		$where_array = array('typeid'=>$parktype);
	  }elseif($parktype != '' and $fdate == '' and $tdate == '' and $stype != ''){
		$where_array = array('typeid'=>$parktype,'slab_status'=>$stype);	
	  }elseif($parktype == '' and $fdate == '' and $tdate == '' and $stype != ''){
		$where_array = array('slab_status'=>$stype);
	  }elseif($parktype == '' and $fdate != '' and $tdate != '' and $stype != ''){
		$where_array = array('Date(intime) >=' => $fdate,'Date(intime) <=' => $tdate,'slab_status'=>$stype);
          }elseif($parktype == '' and $fdate != '' and $tdate != '' and $stype == ''){
                $where_array = array('Date(intime) >=' => $fdate,'Date(intime) <=' => $tdate);
          }else{
                $fdate = date('Y-m-d'); $tdate = date('Y-m-d');
                $where_array = array('Date(intime) <=' => $fdate);
          }

 	  $this->db->select("*");
      $this->db->from('park');
	  $this->db->where('status',0);
	  if(is_array($where_array)){ $this->db->where($where_array); }
	  $this->db->order_by('park.id',"desc");
	  $this->db->join('parktype', 'park.typeid = parktype.id');
          $query = $this->db->get();
          return $query->result();
	
        }

function select_estimate_data_excel($parktype,$fdate,$tdate,$stype)
        {
      
      
    if($parktype != '' and $fdate != '' and $tdate != '' and $stype != ''){
      
    $where_array = array('typeid'=>$parktype,'Date(intime) >=' => $fdate,'Date(intime) <=' => $tdate,'slab_status'=>$stype);
    }elseif($parktype != '' and $fdate != '' and $tdate != '' and $stype == ''){
    $where_array = array('typeid'=>$parktype,'Date(intime) >=' => $fdate,'Date(intime) <=' => $tdate);  
    }elseif($parktype != '' and $fdate == '' and $tdate == '' and $stype == ''){
    $where_array = array('typeid'=>$parktype);
    }elseif($parktype != '' and $fdate == '' and $tdate == '' and $stype != ''){
    $where_array = array('typeid'=>$parktype,'slab_status'=>$stype);  
    }elseif($parktype == '' and $fdate == '' and $tdate == '' and $stype != ''){
    $where_array = array('slab_status'=>$stype);
    }elseif($parktype == '' and $fdate != '' and $tdate != '' and $stype != ''){
    $where_array = array('Date(intime) >=' => $fdate,'Date(intime) <=' => $tdate,'slab_status'=>$stype);
          }elseif($parktype == '' and $fdate != '' and $tdate != '' and $stype == ''){
                $where_array = array('Date(intime) >=' => $fdate,'Date(intime) <=' => $tdate);
          }else{
                $fdate = date('Y-m-d'); $tdate = date('Y-m-d');
                $where_array = array('Date(intime) <=' => $fdate);
          }

    $this->db->select("p.pid,v.name,p.noplate,p.containerno,p.intime,p.outtime,p.hours,p.charges");
    $this->db->from('park as p');
    $this->db->join('parktype as v','v.id = p.typeid','left');
    $this->db->where('status',0);
    if(is_array($where_array)){ $this->db->where($where_array); }
   
          $query = $this->db->get();
          return $query;
  
        }
        function select_collection_data($parktype,$fdate,$tdate,$stype)
        {
          /***********edited for mangesh******************/
          if($parktype != '' and $fdate != '' and $tdate != '' and $stype != ''){
                $where_array = array('typeid'=>$parktype,'Date(outtime) >=' => $fdate,'Date(outtime) <=' => $tdate,'slab_out'=>$stype);
          }elseif($parktype != '' and $fdate != '' and $tdate != '' and $stype == ''){
                $where_array = array('typeid'=>$parktype,'Date(outtime) >=' => $fdate,'Date(outtime) <=' => $tdate);      
          }elseif($parktype != '' and $fdate == '' and $tdate == '' and $stype == ''){
                $where_array = array('typeid'=>$parktype);
          }elseif($parktype != '' and $fdate == '' and $tdate == '' and $stype != ''){
                $where_array = array('typeid'=>$parktype,'slab_out'=>$stype);        
          }elseif($parktype == '' and $fdate == '' and $tdate == '' and $stype != ''){
                $where_array = array('slab_out'=>$stype);
          }elseif($parktype == '' and $fdate != '' and $tdate != '' and $stype != ''){
                $where_array = array('Date(outtime) >=' => $fdate,'Date(outtime) <=' => $tdate,'slab_out'=>$stype);
          }elseif($parktype == '' and $fdate != '' and $tdate != '' and $stype == ''){
                $where_array = array('Date(outtime) >=' => $fdate,'Date(outtime) <=' => $tdate);
          }else{
      		$fdate = date('Y-m-d'); $tdate = date('Y-m-d');
      		$where_array = array('Date(outtime) >=' => $fdate,'Date(outtime) <=' => $tdate);
	        }
          $this->db->select("*");
          $this->db->from('park');
          $this->db->where('status',1);
          if(is_array($where_array)){ $this->db->where($where_array); }
		  $this->db->order_by('park.pid',"desc");
          $this->db->join('parktype', 'park.typeid = parktype.id');
          $query = $this->db->get();
          return $query->result();

        }
        function select_collection_excel_data($parktype,$fdate,$tdate,$stype)
        {
          /***********edited for mangesh******************/
          if($parktype != '' and $fdate != '' and $tdate != '' and $stype != ''){
                $where_array = array('typeid'=>$parktype,'Date(outtime) >=' => $fdate,'Date(outtime) <=' => $tdate,'slab_out'=>$stype);
          }elseif($parktype != '' and $fdate != '' and $tdate != '' and $stype == ''){
                $where_array = array('typeid'=>$parktype,'Date(outtime) >=' => $fdate,'Date(outtime) <=' => $tdate);      
          }elseif($parktype != '' and $fdate == '' and $tdate == '' and $stype == ''){
                $where_array = array('typeid'=>$parktype);
          }elseif($parktype != '' and $fdate == '' and $tdate == '' and $stype != ''){
                $where_array = array('typeid'=>$parktype,'slab_out'=>$stype);        
          }elseif($parktype == '' and $fdate == '' and $tdate == '' and $stype != ''){
                $where_array = array('slab_out'=>$stype);
          }elseif($parktype == '' and $fdate != '' and $tdate != '' and $stype != ''){
                $where_array = array('Date(outtime) >=' => $fdate,'Date(outtime) <=' => $tdate,'slab_out'=>$stype);
          }elseif($parktype == '' and $fdate != '' and $tdate != '' and $stype == ''){
                $where_array = array('Date(outtime) >=' => $fdate,'Date(outtime) <=' => $tdate);
          }else{
          $fdate = date('Y-m-d'); $tdate = date('Y-m-d');
          $where_array = array('Date(outtime) >=' => $fdate,'Date(outtime) <=' => $tdate);
          }
          $this->db->select("p.pid,v.name,p.noplate,p.containerno,p.intime,p.outtime,p.hours,p.charges");
          $this->db->from('park as p');
          $this->db->join('parktype as v','v.id = p.typeid','left');
          $this->db->where('p.status',1);
          if(is_array($where_array)){ $this->db->where($where_array); }
          $this->db->order_by('p.pid',"desc");
          $query = $this->db->get();
          return $query;

        }

        function select_complete_data($parktype,$fdate,$tdate,$stype,$rtype)
        {
		/***********edited for mangesh******************/ 
	      if($parktype != '' and $stype != '' and $rtype != ''){
                $sql = "select * from park 
                        where ((date(outtime) >= '{$fdate}' and date(outtime) <= '{$tdate}') 
                        OR (date(intime) >= '{$fdate}' and date(intime) <= '{$tdate}')) and typeid = '{$parktype}' and slab_status = '{$stype}' and status = '{$rtype}'";  		
		if($rtype == 0){  
                        $sql = "select * from park 
                                where (date(intime) >= '{$fdate}' and date(intime) <= '{$tdate}') and typeid = '{$parktype}' and slab_status = '{$stype}' ";                                  
		 }elseif($rtype ==1){
                        $sql = "select * from park 
                                where (date(outtime) >= '{$fdate}' and date(outtime) <= '{$tdate}') and typeid = '{$parktype}' and slab_out = '{$stype}' ";
                }
	      }elseif($parktype != '' and $stype != '' and $rtype == ''){
                $sql = "select * from park 
                        where ((date(outtime) >= '{$fdate}' and date(outtime) <= '{$tdate}') 
                        OR (date(intime) >= '{$fdate}' and date(intime) <= '{$tdate}')) and typeid = '{$parktype}' and slab_status = '{$stype}'";  		
              }elseif($parktype != '' and $stype == '' and $rtype != ''){ 
		if($rtype == 0){
	                $sql = "select * from park 
        	                where (date(intime) >= '{$fdate}' and date(intime) <= '{$tdate}') and typeid = '{$parktype}' ";  
		}elseif($rtype ==1){
                        $sql = "select * from park 
                                where (date(outtime) >= '{$fdate}' and date(outtime) <= '{$tdate}') and typeid = '{$parktype}'";            		
		}
              }elseif($parktype != '' and $stype == '' and $rtype == ''){
                $sql = "select * from park 
                        where ((date(outtime) >= '{$fdate}' and date(outtime) <= '{$tdate}') 
                        OR (date(intime) >= '{$fdate}' and date(intime) <= '{$tdate}')) and typeid = '{$parktype}'";  
              }elseif($parktype == '' and $stype != '' and $rtype != ''){
                if($rtype == 0){
                        $sql = "select * from park 
                                where (date(intime) >= '{$fdate}' and date(intime) <= '{$tdate}') and slab_status = '{$stype}' ";                
                }elseif($rtype ==1){
                        $sql = "select * from park 
                                where (date(outtime) >= '{$fdate}' and date(outtime) <= '{$tdate}') and slab_out = '{$stype}' ";
                }
              }elseif($parktype == '' and $stype != '' and $rtype == ''){ 
                $sql = "select * from park 
                        where ((date(outtime) >= '{$fdate}' and date(outtime) <= '{$tdate}') 
                        OR (date(intime) >= '{$fdate}' and date(intime) <= '{$tdate}')) and slab_status = '{$stype}'";                           
              }elseif($parktype == '' and $stype == '' and $rtype != ''){ 
                if($rtype == 0){ //echo $fdate.'  '.$tdate;
                        $sql = "select * from park 
                                where (date(intime) >= '{$fdate}' and date(intime) <= '{$tdate}') ";                
                }elseif($rtype ==1){
                        $sql = "select * from park 
                                where (date(outtime) >= '{$fdate}' and date(outtime) <= '{$tdate}') ";
                }
              }
	      else{
		//$fdate = date('Y-m-d'); $tdate = date('Y-m-d');
	      $sql = "select * from park where (date(outtime) >= '{$fdate}' and date(outtime) <= '{$tdate}') OR (date(intime) >= '{$fdate}' and date(intime) <= '{$tdate}')";
	      }
	      $query = $this->db->query($sql);
	      $result = $query->result();
	      return $result;
	
        }

function select_complete_data_excel($parktype,$fdate,$tdate,$stype,$rtype)
        {
    /***********edited for mangesh******************/ 
        if($parktype != '' and $stype != '' and $rtype != ''){
                $sql = "select park.pid,parktype.name,park.noplate,park.containerno,park.intime,park.outtime,park.hours,park.charges,park.status from park 
                        left join parktype on parktype.id = park.typeid
                        where ((date(outtime) >= '{$fdate}' and date(outtime) <= '{$tdate}') 
                        OR (date(intime) >= '{$fdate}' and date(intime) <= '{$tdate}')) and typeid = '{$parktype}' and slab_status = '{$stype}' and status = '{$rtype}'";     
    if($rtype == 0){  
                        $sql = "select park.pid,parktype.name,park.noplate,park.containerno,park.intime,park.outtime,park.hours,park.charges,park.status from park 
                                left join parktype on parktype.id = park.typeid
                                where (date(intime) >= '{$fdate}' and date(intime) <= '{$tdate}') and typeid = '{$parktype}' and slab_status = '{$stype}' ";                                  
     }elseif($rtype ==1){
                        $sql = "select park.pid,parktype.name,park.noplate,park.containerno,park.intime,park.outtime,park.hours,park.charges,park.status from park 
                                left join parktype on parktype.id = park.typeid
                                where (date(outtime) >= '{$fdate}' and date(outtime) <= '{$tdate}') and typeid = '{$parktype}' and slab_out = '{$stype}' ";
                }
        }elseif($parktype != '' and $stype != '' and $rtype == ''){
                $sql = "select park.pid,parktype.name,park.noplate,park.containerno,park.intime,park.outtime,park.hours,park.charges,park.status from park 
                        left join parktype on parktype.id = park.typeid
                        where ((date(outtime) >= '{$fdate}' and date(outtime) <= '{$tdate}') 
                        OR (date(intime) >= '{$fdate}' and date(intime) <= '{$tdate}')) and typeid = '{$parktype}' and slab_status = '{$stype}'";     
              }elseif($parktype != '' and $stype == '' and $rtype != ''){ 
    if($rtype == 0){
                  $sql = "select park.pid,parktype.name,park.noplate,park.containerno,park.intime,park.outtime,park.hours,park.charges,park.status from park 
                          left join parktype on parktype.id = park.typeid
                          where (date(intime) >= '{$fdate}' and date(intime) <= '{$tdate}') and typeid = '{$parktype}' ";  
    }elseif($rtype ==1){
                        $sql = "select park.pid,parktype.name,park.noplate,park.containerno,park.intime,park.outtime,park.hours,park.charges,park.status from park 
                                left join parktype on parktype.id = park.typeid
                                where (date(outtime) >= '{$fdate}' and date(outtime) <= '{$tdate}') and typeid = '{$parktype}'";                
    }
              }elseif($parktype != '' and $stype == '' and $rtype == ''){
                $sql = "select park.pid,parktype.name,park.noplate,park.containerno,park.intime,park.outtime,park.hours,park.charges,park.status from park 
                        left join parktype on parktype.id = park.typeid
                        where ((date(outtime) >= '{$fdate}' and date(outtime) <= '{$tdate}') 
                        OR (date(intime) >= '{$fdate}' and date(intime) <= '{$tdate}')) and typeid = '{$parktype}'";  
              }elseif($parktype == '' and $stype != '' and $rtype != ''){
                if($rtype == 0){ 
                        $sql = "select park.pid,parktype.name,park.noplate,park.containerno,park.intime,park.outtime,park.hours,park.charges,park.status from park 
                                left join parktype on parktype.id = park.typeid
                                where (date(intime) >= '{$fdate}' and date(intime) <= '{$tdate}') and slab_status = '{$stype}' ";                
                }elseif($rtype ==1){
                        $sql = "select park.pid,parktype.name,park.noplate,park.containerno,park.intime,park.outtime,park.hours,park.charges,park.status from park 
                                left join parktype on parktype.id = park.typeid
                                where (date(outtime) >= '{$fdate}' and date(outtime) <= '{$tdate}') and slab_out = '{$stype}' ";
                }
              }elseif($parktype == '' and $stype != '' and $rtype == ''){ 
                $sql = "select park.pid,parktype.name,park.noplate,park.containerno,park.intime,park.outtime,park.hours,park.charges,park.status from park 
                        left join parktype on parktype.id = park.typeid
                        where ((date(outtime) >= '{$fdate}' and date(outtime) <= '{$tdate}') 
                        OR (date(intime) >= '{$fdate}' and date(intime) <= '{$tdate}')) and slab_status = '{$stype}'";                           
              }elseif($parktype == '' and $stype == '' and $rtype != ''){ 
                if($rtype == 0){ //echo $fdate.'  '.$tdate;
                        $sql = "select park.pid,parktype.name,park.noplate,park.containerno,park.intime,park.outtime,park.hours,park.charges,park.status from park 
                                left join parktype on parktype.id = park.typeid
                                where (date(intime) >= '{$fdate}' and date(intime) <= '{$tdate}') ";                
                }elseif($rtype ==1){
                        $sql = "select park.pid,parktype.name,park.noplate,park.containerno,park.intime,park.outtime,park.hours,park.charges,park.status from park 
                                left join parktype on parktype.id = park.typeid
                                where (date(outtime) >= '{$fdate}' and date(outtime) <= '{$tdate}') ";
                }
              }
        else{ 
    //$fdate = date('Y-m-d'); $tdate = date('Y-m-d');
        $sql = "select park.pid,parktype.name,park.noplate,park.containerno,park.intime,park.outtime,park.hours,park.charges,park.status from park 
                left join parktype on parktype.id = park.typeid
                 where (date(outtime) >= '{$fdate}' and date(outtime) <= '{$tdate}') OR (date(intime) >= '{$fdate}' and date(intime) <= '{$tdate}')";
        }
        $query = $this->db->query($sql);
        $result = $query->result();
        return $query;
  
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
        $dept_id = array('-SELECT-');
        $dept_name = array('-SELECT-');

        for ($i = 0; $i < count($result); $i++)
        {
            array_push($dept_id, $result[$i]->id);
            array_push($dept_name, $result[$i]->name);
        }
        return $department_result = array_combine($dept_id,$dept_name);
    }


            //get department table to populate the department name dropdown
    function get_slab_time()
    {
        $this->db->select('id');
        $this->db->select('name');
        $this->db->from('slab');
        $query = $this->db->get();
        $result = $query->result();

        //array to store department id & department name
        $slab_id = array('-SELECT-');
        $slab_name = array('-SELECT-');

        for ($i = 0; $i < count($result); $i++)
        {
            array_push($slab_id, $result[$i]->id);
            array_push($slab_name, $result[$i]->name);
        }
        return $slab_result = array_combine($slab_id, $slab_name);
    }


/******************************time***************************************************/
function select_estimate_data_time($parktype,$fdate,$tdate)
        {
     
    if($parktype != '' and $fdate != '' and $tdate != ''){
      $where_array = array('typeid'=>$parktype,'intime >=' => $fdate,'intime <=' => $tdate);
    }elseif($parktype == '' and $fdate != '' and $tdate != ''){
      $where_array = array('intime >=' => $fdate,'intime <=' => $tdate);  
    }

      $this->db->select("*");
      $this->db->from('park');
    $this->db->where('status',0);
    if(is_array($where_array)){ $this->db->where($where_array); }
    $this->db->order_by('park.id',"desc");
    $this->db->join('parktype', 'park.typeid = parktype.id');
          $query = $this->db->get();
          return $query->result();
  
        }

function select_estimate_data_time_excel($parktype,$fdate,$tdate)
        {
     
    if($parktype != '' and $fdate != '' and $tdate != ''){
      $where_array = array('typeid'=>$parktype,'intime >=' => $fdate,'intime <=' => $tdate);
    }elseif($parktype == '' and $fdate != '' and $tdate != ''){
      $where_array = array('intime >=' => $fdate,'intime <=' => $tdate);  
    }

      $this->db->select("*");
      $this->db->from('park');
    $this->db->where('status',0);
    if(is_array($where_array)){ $this->db->where($where_array); }
    $this->db->order_by('park.id',"desc");
    $this->db->join('parktype', 'park.typeid = parktype.id');
          $query = $this->db->get();
          return $query;
           
        }

function select_collection_data_time($parktype,$fdate,$tdate)
        { 
      
    if($parktype != '' and $fdate != '' and $tdate != ''){
      $where_array = array('typeid'=>$parktype,'outtime >=' => $fdate,'outtime <=' => $tdate);
    }elseif($parktype == '' and $fdate != '' and $tdate != ''){
      $where_array = array('outtime >=' => $fdate,'outtime <=' => $tdate);  
    }

      $this->db->select("*");
      $this->db->from('park');
    $this->db->where('status',1);
    if(is_array($where_array)){ $this->db->where($where_array); }
    $this->db->order_by('park.id',"desc");
    $this->db->join('parktype', 'park.typeid = parktype.id');
          $query = $this->db->get();
          return $query->result();
  
        }

function select_complete_data_time($parktype,$rtype,$fdate,$tdate)
        { 
       // echo $rtype;
      if($rtype == 1){
          if($parktype != '' and $fdate != '' and $tdate != ''){
            $where_array = array('typeid'=>$parktype,'outtime >=' => $fdate,'outtime <=' => $tdate,'status'=>1);
          }elseif($parktype == '' and $fdate != '' and $tdate != ''){
            $where_array = array('outtime >=' => $fdate,'outtime <=' => $tdate,'status'=>1);  
          }
      }
      elseif($rtype == 0){
            if($parktype != '' and $fdate != '' and $tdate != ''){
          $where_array = array('typeid'=>$parktype,'intime >=' => $fdate,'intime <=' => $tdate);
          }elseif($parktype == '' and $fdate != '' and $tdate != ''){
            $where_array = array('intime >=' => $fdate,'intime <=' => $tdate);  
          }
      }/*elseif($rtype == 3){{
            if($parktype != '' and $fdate != '' and $tdate != ''){
            $where_array = array('typeid'=>$parktype,'intime >=' => $fdate,'intime <=' => $tdate);
            }elseif($parktype == '' and $fdate != '' and $tdate != ''){
              $where_array = array('intime >=' => $fdate,'intime <=' => $tdate);  
            }
      }*/

      $this->db->select("*");
      $this->db->from('park');
    if(is_array($where_array)){ $this->db->where($where_array); }
    else{  
             
        $this->db->where("intime BETWEEN '{$fdate}' AND '{$tdate}' ");
        $this->db->or_where("outtime BETWEEN '{$fdate}' AND '{$tdate}' ");
      }
    $this->db->order_by('park.id',"desc");
    $this->db->join('parktype', 'park.typeid = parktype.id');
          $query = $this->db->get();
          return $query->result();
  
        }

        function select_complete_data_time_excel($parktype,$rtype,$fdate,$tdate)
        { 
       // echo $rtype;
      if($rtype == 1){
          if($parktype != '' and $fdate != '' and $tdate != ''){
            $where_array = array('typeid'=>$parktype,'outtime >=' => $fdate,'outtime <=' => $tdate,'status'=>1);
          }elseif($parktype == '' and $fdate != '' and $tdate != ''){
            $where_array = array('outtime >=' => $fdate,'outtime <=' => $tdate,'status'=>1);  
          }
      }
      elseif($rtype == 0){
            if($parktype != '' and $fdate != '' and $tdate != ''){
          $where_array = array('typeid'=>$parktype,'intime >=' => $fdate,'intime <=' => $tdate);
          }elseif($parktype == '' and $fdate != '' and $tdate != ''){
            $where_array = array('intime >=' => $fdate,'intime <=' => $tdate);  
          }
      }/*elseif($rtype == 3){{
            if($parktype != '' and $fdate != '' and $tdate != ''){
            $where_array = array('typeid'=>$parktype,'intime >=' => $fdate,'intime <=' => $tdate);
            }elseif($parktype == '' and $fdate != '' and $tdate != ''){
              $where_array = array('intime >=' => $fdate,'intime <=' => $tdate);  
            }
      }*/

      $this->db->select("park.pid,parktype.name,park.noplate,park.containerno,park.intime,park.outtime,park.hours,park.charges,park.status");
      $this->db->from('park');
    if(is_array($where_array)){ $this->db->where($where_array); }
    else{  
             
        $this->db->where("intime BETWEEN '{$fdate}' AND '{$tdate}' ");
        $this->db->or_where("outtime BETWEEN '{$fdate}' AND '{$tdate}' ");
      }
    $this->db->order_by('park.id',"desc");
    $this->db->join('parktype', 'park.typeid = parktype.id');
          $query = $this->db->get();
          return $query;
  
        }

    }
?>
