<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Charges extends MY_Controller {

	public function index()
	{
		// CRUD table
		$this->load->helper('crud');
		$crud = generate_crud('charges');
		$crud->unset_fields('');
		$crud->columns('typeid','charges');
//		$crud->required_fields('typeid','charges');
		$crud->callback_before_insert(array($this, 'callback_before_create_user'));
		$crud->display_as('typeid','park type');
    		$crud->set_subject('charges');
    		$crud->set_relation('typeid','parktype','name');
		$this->mTitle = "Parking Charges";
   		$this->mViewFile = '_partial/crud';
		$this->mViewData['crud_data'] = $crud->render();
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
