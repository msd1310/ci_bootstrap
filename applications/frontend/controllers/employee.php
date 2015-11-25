<?php
/*
 * File Name: employee.php
 */
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class employee extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->helper('form');
        $this->load->helper('url');
        $this->load->database();
        $this->load->library('form_validation');
        //load the employee model
        $this->load->model('employee_model');
    }
    function index()
    { }
    //index function

    public function pagelist() {
      echo "welcome";
      $this->load->model('employee_model');
      $this->load->library('pagination');
      $config = array();
      $config["base_url"] = base_url() . "index.php/employee/pagelist/";
      $config["total_rows"] = $this->employee_model->record_count();
      $config["per_page"] = 10;
      print_r($config);
      //pagination customization using bootstrap styles
      $config['full_tag_open'] = '<div class="pagination pagination-centered"><ul class="page_test">'; // I added class name 'page_test' to used later for jQuery
      $config['full_tag_close'] = '</ul></div><!--pagination-->';
      $config['first_link'] = '&laquo; First';
      $config['first_tag_open'] = '<li class="prev page">';
      $config['first_tag_close'] = '</li>';

      $config['last_link'] = 'Last &raquo;';
      $config['last_tag_open'] = '<li class="next page">';
      $config['last_tag_close'] = '</li>';

      $config['next_link'] = 'Next &rarr;';
      $config['next_tag_open'] = '<li class="next page">';
      $config['next_tag_close'] = '</li>';

      $config['prev_link'] = '&larr; Previous';
      $config['prev_tag_open'] = '<li class="prev page">';
      $config['prev_tag_close'] = '</li>';

      $config['cur_tag_open'] = '<li class="active"><a href="">';
      $config['cur_tag_close'] = '</a></li>';

      $config['num_tag_open'] = '<li class="page">';
      $config['num_tag_close'] = '</li>';

      $this->pagination->initialize($config);
      $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
      $data['page'] = $page;

      $data["results"] = $this->employee_model->fetch_record($config["per_page"], $page);

      //check if ajax is called
      if($this->input->post('ajax', FALSE))
      {

        echo json_encode(array(
          'results' => $data["results"],
          'pagination' => $this->pagination->create_links()
        ));
      }

      //load the view
      $this->mViewFile = 'pagelist_view';
      $this->mViewData = $data;




  }

public function pp() {

      $this->mViewFile = 'userlist';


}
    public function parklist()
    {
     //load the department_model
     $this->load->model('employee_model');
     //call the model function to get the department data
     $deptresult = $this->employee_model->get_park_list();
     $data['deptlist'] = $deptresult;
     //load the department_view

     $this->mViewFile = 'department_view';
     $this->mViewData = $data;
   }

   public function updateEmployee($empno) {

            $data['empno'] = $empno;
            $this->load->model('employee_model');
            //fetch data from department and designation tables
            $data['parktype'] = $this->employee_model->get_department();
            //fetch employee record for the given employee no
            $data['emprecord'] = $this->employee_model->get_park_record($empno);
            //print_r($data['emprecord'][0]);
            $dd = $data['emprecord'][0];
            echo $timee = $dd->hours;
            echo $typeid = $dd->typeid;
            $data['time'] = $this->employee_model->get_slab($timee);
            $data['charges'] = $this->employee_model->get_charges($timee,$typeid);
            print_r($data);
            $this->form_validation->set_rules('id', 'Id', 'trim|numeric');
            $this->form_validation->set_rules('noplate', 'Number Plate', '');
            $this->form_validation->set_rules('parktype', 'Department', 'callback_combo_check');
            $this->form_validation->set_rules('intime', 'Designation', 'callback_combo_check');
            $this->form_validation->set_rules('outtime', 'Hired Date', '');
            $this->form_validation->set_rules('hours', 'Salary', 'numeric');
            $this->form_validation->set_rules('charges', 'Salary', 'numeric');

            if ($this->form_validation->run() == FALSE)
            {
              //fail validation
              //$this->load->view('employee_view', $data);
              $this->mViewFile = 'update_employee_view';
              $this->mViewData = $data;
            }
            else
            {
              //pass validation
              $data = array(
                'id' => $this->input->post('id'),
                'typeid' => $this->input->post('parktype'),
                'noplate' => $this->input->post('noplate'),
                'intime' => $this->input->post('intime'),
                'outtime' => $this->input->post('outtime'),
                'hours' => $this->input->post('hours'),
                'charges' => $this->input->post('charges'),
              );


            //update employee record
                $this->db->where('id', $empno);
                $this->db->update('park', $data);

                //display success message
                $this->session->set_flashdata('msg', '<div class="alert alert-success text-center">Employee Record is Successfully Updated!</div>');
                redirect('employee/updateEmployee/' . $empno);

              }

              //custom validation function for dropdown input
              function combo_check($str)
              {
                if ($str == '-SELECT-')
                {
                  $this->form_validation->set_message('combo_check', 'Valid %s Name is required');
                  return FALSE;
                }
                else
                {
                  return TRUE;
                }
              }

              //custom validation function to accept only alpha and space input
              function alpha_only_space($str)
              {
                  if (!preg_match("/^([-a-z ])+$/i", $str))
                  {
                    $this->form_validation->set_message('alpha_only_space', 'The %s field must contain only alphabets or spaces');
                    return FALSE;
                  }
                  else
                  {
                    return TRUE;
                  }
                }


    }
    public function userlist() {
    				$this->mViewFile = 'account/userlist';
    }

    public function insertdata()
    {
        //fetch data from department and designation tables
        $data['parktype'] = $this->employee_model->get_department();
        $data['max'] = $this->employee_model->get_maxid();
        //set validation rules
        print_r($data);
        $this->form_validation->set_rules('id', 'Id', 'trim|numeric');
        $this->form_validation->set_rules('noplate', 'Number Plate', '');
        $this->form_validation->set_rules('parktype', 'Department', 'callback_combo_check');
        $this->form_validation->set_rules('intime', 'Designation', 'callback_combo_check');
        $this->form_validation->set_rules('outtime', 'Hired Date', '');
        $this->form_validation->set_rules('hours', 'Salary', 'numeric');
        $this->form_validation->set_rules('charges', 'Salary', 'numeric');

        if ($this->form_validation->run() == FALSE)
        {
            //fail validation
            //$this->load->view('employee_view', $data);
            $this->mViewFile = 'employee_view';
            $this->mViewData = $data;
        }
        else
        {
            //pass validation
            $data = array(
                'pid' => $this->input->post('id'),
                'typeid' => $this->input->post('parktype'),
                'noplate' => $this->input->post('noplate'),
                'intime' => $this->input->post('intime'),
                'outtime' => $this->input->post('outtime'),
                'hours' => $this->input->post('hours'),
                'charges' => $this->input->post('charges'),
            );

            //insert the form data into database
            $this->db->insert('park', $data);

            //display success message
            $this->session->set_flashdata('msg', '<div class="alert alert-success text-center">Employee details added to Database!!!</div>');
            redirect('employee/parklist');
        }

    }

    //custom validation function for dropdown input
    function combo_check($str)
    {
        if ($str == '-SELECT-')
        {
            $this->form_validation->set_message('combo_check', 'Valid %s Name is required');
            return FALSE;
        }
        else
        {
            return TRUE;
        }
    }

    //custom validation function to accept only alpha and space input
    function alpha_only_space($str)
    {
        if (!preg_match("/^([-a-z ])+$/i", $str))
        {
            $this->form_validation->set_message('alpha_only_space', 'The %s field must contain only alphabets or spaces');
            return FALSE;
        }
        else
        {
            return TRUE;
        }
    }
}
?>
