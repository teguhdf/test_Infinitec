<?php

$data=[2,5,1,12,-5,4,-1,3,-3,20,8,7,-2,6,9]
;

function sorting($data){

  $n=count($data);

  for ($i = 0; $i < $n; $i++){

    $k = $i;

    for ($j = $i+1; $j < $n; $j++){

      if ($i < 5 || $i >= 10) {
        if ($data[$j] < $data[$k]){
          $k = $j;
        }
      }else{
        if ($data[$j] > $data[$k]){
          $k = $j;
        }
      }
    }

    $dummy=$data[$i];
    $data[$i]=$data[$k];
    $data[$k]=$dummy;
  }
  return $data;
}

$test = sorting($data);

print_r(implode(" ",$test));

 ?>
