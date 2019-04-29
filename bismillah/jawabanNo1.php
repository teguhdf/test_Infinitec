<?php

$data = [2,1,5,7,4,-8,-3,-1];

$asc = sort($data);
$n = count($data);

for ($i=0; $i < $n ; $i++) {

  $a = $data[$i];

  for ($j=1; $j < $n ; $j++) {
    if ($data[$i] > 0) {
      $a = $data[$j];
    }else{
      $a = $data[$i];
    }
  }

  $dummy=$data[$i];
  $data[$i] = $data[$a];

  $rumus = ($a+$b+$c);

  if ($rumus == 0) {
    echo "hasil";
  }else{
    echo "Not Found";
  }

}




 ?>
