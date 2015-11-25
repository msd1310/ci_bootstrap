<?php
class Park_model extends CI_Model {

	public function __construct()
	{
		$this->load->database();
	}


        public function get_maxid()
        {
			$this->db->select_max('id','maxid');
			$query = $this->db->get('park');
//                        return $query->result_array();


                return $query->row_array();
        }


				public function set_park($id = 0)
				{
					$this->load->helper('url');

					$data = array(
						'typeid' => $this->input->post('typeid'),
						'noplate' => $this->input->post('noplate'),
						'intime' => $this->input->post('intime'),
						//'intime' => '2015-08-26 11:04:39',
							'outtime' => $this->input->post('outtime'),
						'hours' => $this->input->post('totalhours'),
						'charges' => $this->input->post('totalcharges'),
					);

					if ($id === 0) {

						return $this->db->insert('park', $data);

					}
					else {

						$this->db->where('id', $id);
						return $this->db->update('park', $data);

					}


				}

				function get_parktype()
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
		            array_push($id, $result[$i]->id);
		            array_push($name, $result[$i]->name);
		        }
		        return $department_result = array_combine($id, $name);
		    }




////////////////////////////////////////////////////////////////////////////////
	public function get_todos($id = 0)
	{
		if ($id === 0)
		{
			$query = $this->db->get_where('todos',array('completed' => 0));
			return $query->result_array();
		}

		$query = $this->db->get_where('todos', array('id' => $id));
		return $query->row_array();
	}

	public function set_todos($id = 0)
	{
		$this->load->helper('url');

		$data = array(
			'title' => $this->input->post('title'),
			'description' => $this->input->post('description'),
		);

		if ($id === 0) {

			return $this->db->insert('todos', $data);

		}
		else {

			$this->db->where('id', $id);
			return $this->db->update('todos', $data);

		}


	}

	public function completed($id)
	{

		$data = array(
               'completed' => 1
            );

		$this->db->where('id', $id);
		$this->db->update('todos', $data);

	}

}
