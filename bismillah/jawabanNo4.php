<?php

$kata1 = "madam";

function balik_kata($kata1){

  $jmlKata = strlen($kata1);

  for($i = 0; $i < ($jmlKata-1)/2; $i++)
      {
          $tampung = $kata1[$i];
          $kata1[$i] = $kata1[$jmlKata-$i-1];
          $kata1[$jmlKata-$i-1] = $tampung;
      }

      return $kata1;

}

$hasil = balik_kata($kata1);

if ($hasil == $kata1) {
  echo "TRUE";
}else{
  echo "FALSE";
}






 ?>
