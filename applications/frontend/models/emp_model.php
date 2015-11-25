
<?php

function check_changes(){
  $result = $this->db->query('SELECT noplate FROM park WHERE id=1');
  if($result = $result->fetch_object()){
    return $result->counting;
  }
  return 0;
}


function register_changes(){
  $this->db->query('UPDATE park SET noplate = noplate + 1 WHERE id=1');
}


function get_new(){
  if($result = $this->db->query('SELECT * FROM park WHERE id<>1 ORDER BY noplate ')){
    $return = '';
    while($r = $result->fetch_object()){
      //$return .= '<p>id: '.$r->id.' | '.htmlspecialchars($r->noplate).'</p>';
      //$return .= '<hr/>';
    }
    return $return;
  }
}


?>
