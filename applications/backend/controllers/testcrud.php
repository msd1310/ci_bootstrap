<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class testcrud extends MY_Controller {

	public function index()
	{
		// CRUD table
		$this->load->helper('crud');
		$crud = generate_crud('testcrud');
		$crud->unset_fields('lname');
		$crud->columns('fname');
		$crud->callback_before_insert(array($this, 'callback_before_create_user'));

		$this->mTitle = "TestCRUD";
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
