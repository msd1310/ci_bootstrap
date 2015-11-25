<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Vessel extends MY_Controller {

	public function index()
	{
		// CRUD table
		$this->load->helper('crud');
		$crud = generate_crud('vessel');
		$crud->unset_fields('');
		$crud->columns('vessel_name');
//		$crud->required_fields('typeid','charges');
		$crud->callback_before_insert(array($this, 'callback_before_create_vessel'));
		$crud->callback_before_update(array($this, 'callback_before_create_vessel'));
		$crud->display_as('Vessel Name');
    		/*$crud->set_subject('charges');
    		$crud->set_relation('typeid','parktype','name');*/
		$this->mTitle = "Vessel";
   		$this->mViewFile = '_partial/crud';
		$this->mViewData['crud_data'] = $crud->render();
	}
	
	/**
	 * Grocery Crud callback functions
	 */
	public function callback_before_create_vessel($post_array)
	{
		$post_array['vessel_name'] = strtoupper($post_array['vessel_name']);
		return $post_array;
	}
}
