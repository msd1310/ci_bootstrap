<?php
if (!defined('BASEPATH'))
 exit('No direct script access allowed');

class Mcrud extends CI_Model {
  
 function add() {
  $fn = $this->input->post('fn');
  $ln = $this->input->post('ln');
  $ag = $this->input->post('ag');
  $ad = $this->input->post('ad');
  $data = array(
   'firstname' => $fn,
   'lastname' => $ln,
   'age' => $ag,
   'address' => $ad
  );
  $this->db->insert('crud', $data);
 }
 function view() {
  $ambil = $this->db->get('crud');
  if ($ambil->num_rows() > 0) {
   foreach ($ambil->result() as $data) {
    $hasil[] = $data;
   }
   return $hasil;
  }
 }
 function edit($a) {
  $d = $this->db->get_where('crud', array('idcrud' => $a))->row();
  return $d;
 }
 function delete($a) {
  $this->db->delete('crud', array('idcrud' => $a));
  return;
 }
 function update($id) {
  $fn = $this->input->post('fn');
  $ln = $this->input->post('ln');
  $ag = $this->input->post('ag');
  $ad = $this->input->post('ad');
  $data = array(
   'firstname' => $fn,
   'lastname' => $ln,
   'age' => $ag,
   'address' => $ad
  );
  $this->db->where('idcrud', $id);
  $this->db->update('crud', $data);
 }
}
