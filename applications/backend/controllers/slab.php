<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Slab extends MY_Controller {

	public function index()
	{
		// CRUD table
		$this->load->helper('crud');
		$crud = generate_crud('slab');
		$crud->unset_fields('');
		$crud->columns('name','frmhrs','tohrs');
		$crud->required_fields('name','frmhrs','tohrs');
		$crud->unique_fields('name');
		$crud->callback_before_insert(array($this, 'callback_before_create_user'));
		$this->mTitle = "Hours Slab";
       //         $this->mViewFile = 'admin/reset_password';
  //              $this->mViewData['target'] = $this->backend_users->get($user_id);

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
