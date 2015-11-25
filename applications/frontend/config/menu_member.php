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
		'name'      => 'home',
		'url'       => site_url(),
		'icon'      => 'fa fa-home'
	),

	'Add' => array(
		'name'      => lang('home'),
		//'url'       => site_url('account/logout'),
		'url'       => site_url('account/insertdata'),
		'icon'      => 'fa fa-sign-out',
	),
	'insertdata' => array(
		'name'      => 'insertdata',
		'url'       => site_url('account/insertdata'),
		'icon'      => 'fa fa-sign-out',
		),

	'logout' => array(
		'name'      => 'logout',
		'url'       => site_url('account/logout'),
		'icon'      => 'fa fa-sign-out',
	),

);
