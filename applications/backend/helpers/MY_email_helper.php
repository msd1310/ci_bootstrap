<?php

/**
 * https://ellislab.com/codeigniter/user-guide/libraries/email.html
 */

// Send email using email.config (overrided)
function send_email($to_email, $to_name, $subject, $view, $view_data = NULL)
{
	// load values from config
	$CI =& get_instance();
	$CI->load->library('email');
	$CI->config->load('email');
	$from_email = $CI->config->item('from_email');
	$from_name = $CI->config->item('from_name');
	$subject = $CI->config->item('subject_prefix').$subject;

	// basic parameters
	$CI->email->from($from_email, $from_name);
	$CI->email->to($to_email, $to_name);
	$CI->email->subject($subject);
	//$CI->email->cc($from_email, $from_name);
	//$CI->email->reply_to($from_email, $from_name);
	
	// confirm to send
	$msg = $CI->load->view('email/'.$view, $view_data, TRUE);
	$CI->email->message($msg);
	$CI->email->send();

	//echo $CI->email->print_debugger();
}