<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| Menu
| -------------------------------------------------------------------------
| This file lets you define navigation menu items on sidebar.
|
*/

$config['menu'] = array(

	// end of example
);


if (ENABLED_MEMBERSHIP)
{
	$config['menu']['signup'] = array(
		'name'      => lang('sign_up'),
		'url'       => site_url('account/signup'),
		'icon'      => 'fa fa-plus-square',
	);

	$config['menu']['login'] = array(
		'name'      => lang('login'),
		'url'       => site_url('account/login'),
		'icon'      => 'fa fa-sign-in',
	);
	
}
