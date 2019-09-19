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
		
function egzistuoja($vardas) {	
global $db;	
$resu0="SELECT * FROM specialistai where vardas='$vardas'";
$req0=mysqli_query($db,$resu0);
while( $raw0=mysqli_fetch_assoc($req0)) {
	return true;
}
}

function priimtas($id) {	
global $db;	
$resu0="SELECT * FROM priimti where kid='$id'";
$req0=mysqli_query($db,$resu0);
while( $raw0=mysqli_fetch_assoc($req0)) {
	return true;
}
}


function kelintas($klientas) {	
global $db;	
$i =1;
$m = mysqli_query($db,"SELECT klientas FROM klientas");	
while ($row = mysqli_fetch_assoc($m)) {
if($row['klientas'] == $klientas)
{
return $i;
}
$i++;
}
}


function klientai() {	
global $db;	
$i=0;
$m = mysqli_query($db,"SELECT klientas FROM klientas");	
while ($row = mysqli_fetch_assoc($m)) {
$i++;
}
return $i;
}

function klientas($skaicius) {	
global $db;	
$i=1;
$m = mysqli_query($db,"SELECT klientas FROM klientas");	
while ($row = mysqli_fetch_assoc($m)) {
if($i == $skaicius)
{
return $row['klientas'];
}
$i++;
}
}		
?>