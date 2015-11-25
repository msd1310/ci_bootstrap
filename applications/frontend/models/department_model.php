<?php
class department_model extends CI_Model{
    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }

    //fetch department details from database
    function get_department_list($limit, $start)
    {
        $sql = 'select var_dept_name, var_emp_name from tbl_dept, tbl_emp where tbl_dept.int_hod = tbl_emp.int_id order by var_dept_name limit ' . $start . ', ' . $limit;
        $query = $this->db->query($sql);
        return $query->result();
    }
}
?>
