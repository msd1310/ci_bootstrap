<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Parking extends MY_Controller {

	public function index()
	{
		// CRUD table
		$this->load->helper('crud');
		$crud = generate_crud('park');
		$crud->unset_fields('pid');
		$crud->columns('name','typeid','intime','outtime','hours','charges','status');
		$crud->callback_before_insert(array($this, 'callback_before_create_user'));

		$this->mTitle = "Parking";
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
