<?php
        session_start();
        $db_host = 'localhost';
        $db_user = 'rimas_nfq';
        $db_pass = 'svxMWgXt';
        $db_name = 'rimas_nfq';    
        //connect db
        $db=mysqli_connect($db_host,$db_user,$db_pass,$db_name);
        mysqli_select_db($db,"rimas_nfq");
        mysqli_set_charset($db,'utf8');

        
require_once('classes/user.php');
require_once('classes/stats.php');

function laikas($sekundes)
{

    $laikas = "";
    $days = intval(intval($sekundes) / (3600*24));
    if($days> 0){
        $laikas .= "$days d. ";
    }

    $hrs = (intval($sekundes) / 3600) % 24;
    if($hrs > 0){
        $laikas .= "$hrs val. ";
    }
    
    $minutes = (intval($sekundes) / 60) % 60;
    if($minutes > 0){
        $laikas .= "$minutes min. ";
    }

    $sec = intval($sekundes) % 60;
    if ($sec > 0) {
        $laikas .= "$sec sek. ";
    }

    return $laikas;
}

    
?>