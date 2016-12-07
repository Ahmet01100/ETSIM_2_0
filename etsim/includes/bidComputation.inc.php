<?php
/**
 * Created by PhpStorm.
 * User: kolo
 * Date: 05/01/16
 * Time: 21:49
 */
/**
 * @param $bidarray must be an array of an array : [ [type,price,volume] ...]
 */
function computebids(Array $array_input,$demand){
    $temBid=[];
    $rejected=[];
    //echo "longueur" . sizeof($array_input);
    foreach($array_input as $a){
        if($a[2]==0 && $a[1]==0)
            $rejected[]=$a;
        else{
            $temBid[]=$a;
        }
    }
    $bidarray=$temBid;
   // echo "longueur" . sizeof($bidarray);


    $price_sorted_array =$bidarray;
    usort($price_sorted_array,"custom_sort_1");
    $volume_sorted_array=$bidarray;
    usort($volume_sorted_array,"custom_sort_2");

    $cumulatedVolume=getSumFromArray($volume_sorted_array,2);
    $i=0;
    try
    {
        while($demand>=$cumulatedVolume[$i][2] && $i<sizeof($price_sorted_array)){
            $i++;
        }
    }
    catch(Exception $e)
    {
        echo $e->getMessage();
    }
    
    $cp=floatval($price_sorted_array[$i-1][1]);
    $q=$demand;
    $nbc=0;
    $equbidvol=[];
    $volToShare=$q-$cumulatedVolume[$i][2];
    foreach ($price_sorted_array as $p){
        if($p[1]==$cp){
            if($p[2]!=0)
               $equbidvol[]=$p[2];
            $nbc++;
        }
    }
    $volToShareRemain=$volToShare;
    $nbAtMaxvol=1;
    $equalVol=$volToShareRemain/$nbc;

    if($nbc>1){
        while($nbAtMaxvol>0){
            $nbPriceRmeain=sizeof($equbidvol);
            if($nbPriceRmeain==0)
                break; // in this case the demand can't be filled with the Clearance price
            $equalVol=$volToShareRemain/$nbPriceRmeain;

            $temparray=mymin($equbidvol,2);
            $minInd=$temparray[1];
            $minVol=$temparray[0];
            $nbAtMaxvol=0;
            //accepter si inferieur au volume moyen
            if($minVol<$equalVol and sizeof($equbidvol)>0){
                $volToShareRemain-=$minVol;
                unset($equbidvol[$minInd]);
                $nbAtMaxvol=1;
            }
        }
    }


//let's sum up :
    //cp is market clearance price
    //q is exchange volume
    //an order is accepted if it's under or egal the clearance price cp
    //an order is rejected other way
    $accepted=[];
    $acceptedVol=0;
 //   echo "</br> nous avons un cp de $cp ainsi que un nbc de $nbc  et equavol est de $equalVol </br>";
    foreach($price_sorted_array as $a){
   //     echo" nous avons un element avec un volume de ".$a[2]." et un prix de ".$a[1]." voila";
        if($a[1]<$cp){
            $a[2]=min($a[2],$equalVol);
            $accepted[]=$a;
            $acceptedVol+=$a[2];
     //       echo " et celui ci est accepté </br>";
            continue;
        }
        if($a[1]==$cp and $nbc==1){
            $i=array_search($a,$price_sorted_array);
            $i= $i-1<0? 0 : $i-1;
            $a[2]=min($a[2],$q-$acceptedVol);
            $a[2]=min($a[2],$equalVol);
       //     echo " son nouveau volume est de ".$a[2];
            $acceptedVol+=$a[2];
            if($a[2]>0) $accepted[]=$a;
    //        echo " et celui ci est accepté </br>";
            continue;
        }
        if($a[1]==$cp and $nbc>1){
            $a[2]=min($a[2],$equalVol);
        //    echo " son nouveau volume est de ".$a[2];
            if($a[2]>0) $accepted[]=$a;
            $acceptedVol+=$a[2];
      //      echo " et celui ci est accepté </br>";

            continue;
        }
        else{
     //       echo " et celui ci est refusé </br>";

            $rejected[]=$a;
        }

    }
  //  echo "le nombre de résultat accepté est de ".sizeof($accepted)."</br>";
    return [$q,$cp,$accepted,$rejected];
}

function mymin(Array $array,$index){
    $result=[];
    foreach($array as $i=>$a){
        if(sizeof($result)>0) {
            if ($result[0][$index] < $a[$index])
                $result[0] = $a;
                $result[1] = $i;
        }
        else{
            $result[]=$a;
            $result[]=$i;
        }
    }
    return $result;
}
function getSumFromArray(Array $array,$index){
    $result=[];
    $result[]=$array[0];
    $i=1;

    while($i<sizeof($array)){

        $t=$array[$i];
        $t[$index]+=$result[$i-1][$index];
        $result[]=$t;
        $i++;
    }
    return $result;
}
function custom_sort_0($a,$b){
    return strcmp($a[0],$a[0]);
}
function custom_sort_1($a,$b){
    if ($a[1]==$b[1])
        return 0;
    if ($a[1]>$b[1]){
        return 1;
    }
    if ($a[1]<$b[1]){
        return -1;
    }
}
function custom_sort_2($a,$b){
    if ($a[2]==$b[2])
        return 0;
    if ($a[2]>$b[2]){
        return 1;
    }
    if ($a[2]<$b[2]){
        return -1;
    }
}

function pretty_printer(array $a){
    echo "i:".$a[0].' p:'.$a[1].' v:'.$a[2].'<br/>';
}