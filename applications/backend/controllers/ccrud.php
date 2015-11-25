<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Ccrud extends CI_Controller {
 
 public function index()
 {
  $this->load->model('Mcrud','mcrud');
  $data['data_get'] = $this->mcrud->view();
  $this->load->view('header');
  $this->load->view('vcrud', $data);
  $this->load->view('footer');
 }
 function add() {
  $this->load->view('header');
  $this->load->view('vcrudnew');
  $this->load->view('footer');
 }
 function edit() {
  $kd = $this->uri->segment(3);
  if ($kd == NULL) {
   redirect('ccrud');
  }
  $dt = $this->mcrud->edit($kd);
  $data['fn'] = $dt->firstname;
  $data['ln'] = $dt->lastname;
  $data['ag'] = $dt->age;
  $data['ad'] = $dt->address;
  $data['id'] = $kd;
  $this->load->view('header');
  $this->load->view('vcrudedit', $data);
  $this->load->view('footer');
 }
 function delete() {
  $u = $this->uri->segment(3);
  $this->mcrud->delete($u);
  redirect('ccrud');
 }
 function save() {
  if ($this->input->post('mit')) {
   $this->mcrud->add();
   redirect('ccrud');
  } else{
   redirect('ccrud/tambah');
  }
 }
 function update() {
  if ($this->input->post('mit')) {
   $id = $this->input->post('id');
   $this->mcrud->update($id);
   redirect('ccrud');
  } else{
   redirect('ccrud/edit/'.$id);
  }
 }
}
 
/* End of file welcome.php */
/* Location: ./application/controllers/ccrud.php */
