<?php

  $data = [1,1,4,4,4,5,5,6,8,9,10,10,12,13,13,17];

  function test($data){

    $n = count($data);

    for ($i=0; $i < $n ; $i++) {
        $k = $i;
        $x= 0;
        for ($j = $i+1; $j < $n ; $j++) {
            $x = $x+1;
          if ($data[$j] == $data[$k] ) {
              $k = $j;
              if ($data[$k] == $data[$x]) {
                $k2 = $x;
              }
          }
        }

        $dummy=$data[$i];
        $data[$k] = '';
        $data[$k2] = '';
        $data[$i]=$dummy;
    }
    return $data;

  }

$test = test($data);
print_r(implode(" ",$test));

 ?>
