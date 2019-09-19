<!DOCTYPE html>
<html>
<head>
<title>Kliento valdymo panelė</title>
<link rel="stylesheet" href="css/styles.css">
<meta http-equiv="refresh" content="5">
</head>
<body>

<?php



include("config.php");

if(isset($_GET['klientas']) and isset($_GET['kodas']))
{

$id = $_GET['klientas'];
$id = str_replace("%20"," ",$id);
$kodas = $_GET['kodas'];
$row = mysqli_fetch_assoc(mysqli_query($db,"SELECT * FROM `vp` WHERE klientas = '$id'"));
$kliento_vardas = $row['klientas'];

$row = mysqli_fetch_assoc(mysqli_query($db,"SELECT * FROM `vp` WHERE klientas = '$id'"));
$kliento_kodas= $row['kodas'];

if ($kliento_vardas == $id)
{
		if($kliento_kodas == $kodas)
		{
		$re = mysqli_fetch_assoc(mysqli_query($db,"SELECT * FROM `laukimo_laikas` where klientas = '$kliento_vardas' "));
		$laukimas = $re['laukimas']-time();
		if($laukimas > 0)
		{
		echo "Sveiki, $kliento_vardas , Jūsų apytikslis laukimo laikas pas specialistą yra :  $laukimas s<br>";	
		}
		else
		{
		echo "Sveiki, $kliento_vardas, artimiausiu metu, jus pakviesime<br>";	
		}		
echo "Jūs esate eilėje ".kelintas("$kliento_vardas")." iš ".klientai()."<br>";
echo "<a href='vp.php?klientas=$kliento_vardas&kodas=$kliento_kodas&v=trinti'>[Atšaukti apsilankymą]</a><br>";
if(isset($_GET['v']) and $_GET['v'] == "trinti" )
{
mysqli_query($db,"DELETE FROM klientas WHERE klientas = '$kliento_vardas'");
mysqli_query($db,"DELETE FROM vp WHERE klientas = '$kliento_vardas'");
mysqli_query($db,"DELETE FROM laukimo_laikas WHERE klientas = '$kliento_vardas'");
header("location: index.php");
	
}
if(kelintas("$kliento_vardas") < klientai())
{
	$keitimo_vardas = klientas(kelintas("$kliento_vardas")+1);
	echo "<a href='vp.php?klientas=$kliento_vardas&kodas=velinti&kuo=$keitimo_vardas'>[Pavėlinti apsilankymą]</a>";
}

}
		elseif($kodas == "velinti")
		{
			if(kelintas("$kliento_vardas") == klientai() )
			{
				echo "Vėlinimas negalimas, esate paskutinis eilėje.";
			}
			elseif(kelintas("$kliento_vardas") < klientai() )
			{
			$keitimo_vardas = klientas(kelintas("$kliento_vardas")+1);
			$vardas = $_GET['klientas'];
			$keitimas = $_GET['kuo'];
			if(kelintas("$keitimas") > kelintas("$vardas") )
			{
			$row = mysqli_fetch_assoc(mysqli_query($db,"SELECT id FROM `klientas` WHERE klientas = '$vardas'"));
			$kliento_id = $row['id'];	
			$row = mysqli_fetch_assoc(mysqli_query($db,"SELECT id FROM `klientas` WHERE klientas = '$keitimas'"));
			$keitimo_id = $row['id'];	
			mysqli_query($db,"UPDATE klientas SET klientas = '$vardas' WHERE id = '$keitimo_id '");
			mysqli_query($db,"UPDATE klientas SET klientas = '$keitimas' WHERE id = '$kliento_id '");
			header("location: vp.php?klientas=$vardas&kodas=$kliento_kodas");
			
			}

			
			}
			
		}

}
}
else
{
header("location: index.php");	
}

?>

</body>
</html>


