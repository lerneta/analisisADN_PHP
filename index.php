<?php

$adn = array(
  "ATGCGA",
  "CAGTGC",
  "TTATGT",
  "AGAAGG",
  "CCCCTA",
  "TCACTG"
);
isForceUser($adn);

$last;

function isForceUser($dna){
  
  $isForce = false;

  //Recorremos las cadenas de adn
  for ($x=0;$x<count($dna); $x++) { 
  $equalh = ""; 
  $str = $dna[$x];
  $sequence = str_split($str);


  //Detectar lineas horizontales
  $isForce = detecth($sequence);

//Regitramos duplicados verticalmente
$vals1;
$vals2;
$vals3;

  for ($i=0;$i<5; $i++) { 
    if ($last[$i]==$sequence[$i]){
      if ($x==1){
      $vals1 = $vals1 . $sequence[$i];
      }
      if ($x==3){
        $vals2 = $vals2 . $sequence[$i];
        }
      if ($x==5){
        $vals3 = $vals3 . $sequence[$i];
        }
    }else{
      if ($x==1){
        $vals1 = $vals1 . "0";
        }
        if ($x==3){
          $vals2 = $vals2 . "0";
          }
        if ($x==5){
          $vals3 = $vals3 . "0";
          }
    }

//Detectamos repeticiones diagonales hacia derecha
$vald1;
$vald2;
$vald3;
    if ($last[$i-1]==$sequence[$i]){
      if ($x==1){
      $vald1 = $vald1 . $sequence[$i];
      }
      if ($x==3){
        $vald2 = $vald2 . $sequence[$i];
        }
      if ($x==5){
        $vald3 = $vald3 . $sequence[$i];
        }
    }else{
      if ($x==1){
        $vald1 = $vald1 . "0";
        }
        if ($x==3){
          $vald2 = $vald2 . "0";
          }
        if ($x==5){
          $vald3 = $vald3 . "0";
          }
    }



    //Detectamos repeticiones diagonales hacia izquierda
$vali1;
$vali2;
$vali3;
    if ($last[$i]==$sequence[$i-1]){
      if ($x==1){
      $vali1 = $vali1 . $sequence[$i];
      }
      if ($x==3){
        $vali2 = $vali2 . $sequence[$i];
        }
      if ($x==5){
        $vali3 = $vali3 . $sequence[$i];
        }
    }else{
      if ($x==1){
        $vali1 = $vali1 . "0";
        }
        if ($x==3){
          $vali2 = $vali2 . "0";
          }
        if ($x==5){
          $vali3 = $vali3 . "0";
          }
    }

  }

  //Guardamos la secuencia
  $last= $sequence;

}

//Detectamos repeticiones verticales
$repv_1 = str_split($vals1);
$repv_2 = str_split($vals2);
$repv_3 = str_split($vals3);
for ($i=0;$i<5; $i++) { 

  if ($repv_1[$i]==$repv_2[$i] && $repv_2[$i]!="0"){
      $isForce=true;
  }
  if ($repv_2[$i]==$repv_3[$i] && $repv_2[$i]!="0"){
    $isForce=true;
  }
}

//Detectamos repeticiones diagonales derecha
$vald_1 = str_split($vald1);
$vald_2 = str_split($vald2);
$vald_3 = str_split($vald3);
for ($i=0;$i<5; $i++) { 

  if ($vald_1[$i]==$vald_2[$i+1] && $vald_2[$i]!="0"){
    $isForce= true;
  }
  if ($vald_2[$i]==$vald_3[$i+1] && $vald_2[$i]!="0"){
    $isForce= true;
  }
}

//Detectamos repeticiones diagonales izquierda
$vali_1 = str_split($vali1);
$vali_2 = str_split($vali2);
$vali_3 = str_split($vali3);
for ($i=0;$i<5; $i++) { 

  if ($vali_1[$i+1]==$vali_2[$i] && $vali_2[$i]!="0"){
    $isForce= true;
  }
  if ($vali_2[$i+1]==$vali_3[$i] && $vali_2[$i]!="0"){
    $isForce= true;
  }
}


return $isForce;
}

function detecth($sequence){
  //Comparamos las secuencias horizontales
  $result1="";
  $result2="";
  $result3="";
  if ($sequence[0]==$sequence[1]){
    $result1 = $sequence[1];
  }
  if ($sequence[2]==$sequence[3]){
  $result2 = $sequence[3];
  }
  if ($sequence[4]==$sequence[5]){
    $result3 = $sequence[5];
  }


//Detectamos repeticiones horizontales
  if ($result1!='' && $result1==$result2){
    return true;
  }
  if ($result2!='' && $result2==$result3){
    return true;
  }

  return false;

}

?>
