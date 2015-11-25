<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Yard extends MY_Controller {

	public function index()
	{
		// CRUD table
		$this->load->helper('crud');
		$crud = generate_crud('yard');
		$crud->unset_fields('');
		$crud->columns('yard_name');
		$crud->required_fields('yard_name');
		$crud->callback_before_insert(array($this, 'callback_before_create_yard'));
		$crud->callback_before_update(array($this, 'callback_before_create_yard'));
		$crud->display_as('Yard Name');
    		/*$crud->set_subject('charges');
    		$crud->set_relation('typeid','parktype','name');*/
		$this->mTitle = "Yard Master";
   		$this->mViewFile = '_partial/crud';
		$this->mViewData['crud_data'] = $crud->render();
	}
	
	/**
	 * Grocery Crud callback functions
	 */
	public function callback_before_create_vessel($post_array)
	{
		$post_array['yard_name'] = strtoupper($post_array['yard_name']);
		return $post_array;
	}
}
