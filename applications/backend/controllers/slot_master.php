<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Slot_master extends MY_Controller {

	public function index()
	{
		// CRUD table
		$this->load->helper('crud');
		$crud = generate_crud('slot_master');
		$crud->unset_fields('');
		$crud->columns('name','from','to');

 			$crud->set_rules('from','From','numeric');
 			$crud->set_rules('to','To','numeric');
 			$crud->required_fields('name','from','to');
 			
 			$crud->callback_add_field('name', function () {
        		return '<input type="text" maxlength="3" value="" name="name">';
    		});
 			
 		$crud->callback_edit_field('name',array($this,'edit_field_callback_1'));

		$crud->display_as('Slot Name','From','To');
    		
		$this->mTitle = "Slot Master"; 
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
	public function edit_field_callback_1($value, $primary_key)
	{
	    return '<input type="text" maxlength="3" value="'.$value.'" name="name">';
	}
}
