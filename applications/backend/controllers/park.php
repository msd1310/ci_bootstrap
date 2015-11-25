<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Park extends MY_Controller {

	public function index()
	{
		// CRUD table
		$this->load->helper('crud');
		$crud = generate_crud('parktype');
		$crud->unset_fields('');
		$crud->columns('name');
		$crud->required_fields('name');
		$crud->unique_fields('name');
		$crud->callback_before_insert(array($this, 'callback_before_create_user'));

		$this->mTitle = "Park Type";
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
