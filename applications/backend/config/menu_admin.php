<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| Menu
| -------------------------------------------------------------------------
| This file lets you define navigation menu items on sidebar.
|
*/

$config['menu'] = array(

	'home' => array(
		'name'      => 'Home',
		'url'       => site_url(),
		'icon'      => 'fa fa-home'
	),

	'user' => array(
		'name'      => 'Users',
		'url'       => site_url('user'),
		'icon'      => 'fa fa-users'
	),

	// Example to add sections with subpages
	'masters' => array(
		'name'      => 'Masters',
		'url'       => site_url('example'),
		'icon'      => 'fa fa-cog',
		'children'  => array(
			'Park Type'		=> site_url('park'),
			'Slab'		=> site_url('slab'),
			'Charges'		=> site_url('charges'),
			'Plaza'		=> site_url('plaza'),
			'Slot Mater'		=> site_url('slot_master'),
			'Yard'		=> site_url('yard'),
			'Vessel'		=> site_url('vessel'),
			'Yard-Slot Master'		=> site_url('yard_slot'),
			'Vessel-Slot Master'		=> site_url('yard_slot/insertVessel'),
			'Vessel-Slot Reallocate'		=> site_url('yard_slot/reallocate'),
			)
	),
	// end of example
	// Reports section starts
	'Reports' => array(
		'name'      => 'Reports',
		'url'       => site_url('example'),
		'icon'      => 'fa fa-cog',
		'children'  => array(
			'Estimate Report'		=> site_url('report/index'),
			'Collection Report'		=> site_url('report/collection'),
			'Vehicle Reports'		=> site_url('report/complete_report'),
		)
	),
	//report section ends

	'admin' => array(
		'name'      => 'Administration',
		'url'       => site_url('admin'),
		'icon'      => 'fa fa-cog',
		'children'  => array(
			'Backend Users'		=> site_url('admin/backend_user'),
		)
	),

	'logout' => array(
		'name'      => 'Sign out',
		'url'       => site_url('account/logout'),
		'icon'      => 'fa fa-sign-out'
	),
);
