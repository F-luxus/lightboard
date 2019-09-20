<!DOCTYPE html>
<html>
<head>
<title>Švieslentė</title>

<link rel="stylesheet" href="css/styles.css">
<link rel="icon" href="favicon.ico" type="image/x-icon" />
<meta http-equiv="refresh" content="5">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

</head>
<body>

<?php
include("config.php");
$m = mysqli_query($db,"SELECT * FROM klientas ORDER BY laikas ASC LIMIT 5");	
$l = 1;
while ($row = mysqli_fetch_assoc($m)) {
	$klientas = $row['klientas'];
	$kliento_id = $row['id'];
	if(!priimtas($kliento_id) == true)
	{
	if($l == 1)
	{
		$re = mysqli_fetch_assoc(mysqli_query($db,"SELECT * FROM `laukimo_laikas` where klientas = '$klientas' "));
		$laukimas = $re['laukimas']-time();
		if($laukimas >0)
		{
		echo "<center><div class=digital>$klientas - numatomas vizitas po ".laikas($laukimas)."</div></center><br>";		
		}
		elseif($laukimas <0)
		{
		echo "<center><div class=digital>$klientas - netrukus pakviesime</div></center><br>";	
		}	
	echo "<div class=sarasas><div class=h1><center>Laukiantys eilėje</center></div><br>";		
	}
	else
	{
		echo "<b>$l.</b> $klientas<br>";		
	}

	$l++;		
	}


}
echo "</div>";
if(empty($laukimas))
{
echo "<center><div class=digital>Niekas nelaukia - galite <a href='index.php'>registruotis</a></div></center><br>";
}
?>

</body>
</html>


