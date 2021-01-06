<?php
function change_order($start_person,$playernames): array{
    $change_array = array_splice($playernames, 0,$start_person);
  //var_dump($change_array);
  if(count($change_array) > 0){
      foreach ($change_array as  $value) {
        array_push($playernames,$value);
      }
    }
    
  return $playernames;
}
?>