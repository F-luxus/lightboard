<!DOCTYPE html>
<html>
<head>
<title>Specialisto puslapis</title>
<link rel="stylesheet" href="css/styles.css">
</head>
<body>

<?php
include("config.php");
if (isset($_GET['id'])) {
	if($_GET['id']== "login"){
		if (egzistuoja($_POST['name']) ==true) {
		$_SESSION["specialistas"] = $_POST['name'];
		header("location: admin.php?id=klientai");
		}
		
	}
	if($_GET['id']== "klientai"){
		if(isset($_SESSION["specialistas"]))
		{
		echo "Laukiantys klientai: <br>";	
		$m = mysqli_query($db,"SELECT * FROM klientas ORDER BY laikas ASC");
		while ($row = mysqli_fetch_assoc($m)) {
			$klientas = $row['klientas'];
			$laikas = $row['laikas'];
			$k = $row['id'];
			if(priimtas($k) == true)
			{
			echo "$klientas $laikas <a href='admin.php?id=klientai&klientas=$k'>[atleisti]</a><br>";		
			}
			else
			{
			echo "$klientas $laikas <a href='admin.php?id=klientai&klientas=$k'>[priimti]</a><br>";		
			}
				
		}
		echo "<br><br>Priimti klientai: <br>";	
		$ki = mysqli_query($db,"SELECT * FROM priimti ORDER BY kada ASC");
		while ($row = mysqli_fetch_assoc($ki)) {
			$klientas = $row['klientas'];
			$k = $row['kid'];
			echo "$klientas <a href='admin.php?id=klientai&klientas=$k'>[atleisti]</a><br>";		
			
				
		}
		if(isset($_GET['klientas']))
			if(is_numeric($_GET['klientas']))
			{
				$klientas = $_GET['klientas'];
				$specialistas = $_SESSION["specialistas"];
			if(priimtas($klientas) == true)
			{
				
				$row = mysqli_fetch_assoc(mysqli_query($db,"SELECT * FROM `priimti` WHERE kid = '$klientas'"));
				$kliento_vardas = $row['klientas'];
				$row = mysqli_fetch_assoc(mysqli_query($db,"SELECT * FROM `priimti` WHERE kid = '$klientas'"));
				$kliento_priimimas = $row['kada'];
				$kliento_aptarnavimas = date('Y-m-d H:i:s');
				$row = mysqli_fetch_assoc(mysqli_query($db,"SELECT * FROM `priimti` WHERE kid = '$klientas'"));
				$kliento_req = $row['reg'];
				$laukimas = strtotime($kliento_priimimas)-strtotime($kliento_req);
				$aptarnavimas = strtotime($kliento_aptarnavimas)-strtotime($kliento_priimimas);
				$kliento_req = explode(" ","$kliento_req");
				mysqli_query($db,"INSERT INTO statistika (aptarnavo,klientas,registracijos_data,registracijos_laikas ,laukimas,aptarnavimas) VALUES ('$specialistas','$kliento_vardas','$kliento_req[0]','$kliento_req[1]','$laukimas','$aptarnavimas')");
				mysqli_query($db,"DELETE FROM klientas WHERE id = '$klientas'");
				mysqli_query($db,"DELETE FROM priimti WHERE kid = '$klientas'");
				mysqli_query($db,"DELETE FROM vp WHERE klientas = '$kliento_vardas'");
				mysqli_query($db,"DELETE FROM laukimo_laikas WHERE klientas = '$kliento_vardas'");
				$n = mysqli_query($db,"SELECT * FROM statistika");
				$i = 0;	
				$suma = 0;	
				while ($row = mysqli_fetch_assoc($n)) {
				$suma +=$row['aptarnavimas'];

				$i++;
				}
				$dabar = time();
				$row = mysqli_fetch_assoc(mysqli_query($db,"SELECT * FROM `priimti` WHERE kid = '$klientas'"));
				$kliento_vardas = $row['klientas'];
				$row = mysqli_fetch_assoc(mysqli_query($db,"SELECT * FROM `vidurkis` WHERE id = '1'"));
				$kliento_vidurkis = round($suma/$i)-$row['vidurkis'];
				$vidurkis = round($suma/$i);
				mysqli_query($db,"UPDATE vidurkis SET vidurkis = '$vidurkis' WHERE id = 1");
				$mz = mysqli_query($db,"SELECT * FROM laukimo_laikas");	
				while ($row = mysqli_fetch_assoc($mz)) {
				$kid = $row['id'];	
				$laikas = $row['laukimas'];
				$pakeitimas = $laikas+($kliento_vidurkis);
				mysqli_query($db,"UPDATE laukimo_laikas SET laukimas = '$pakeitimas' WHERE id = $kid");	
				}				
				header("location: admin.php?id=klientai");
			}
			else
			{
				$row = mysqli_fetch_assoc(mysqli_query($db,"SELECT * FROM `klientas` WHERE id = '$klientas'"));
				$kliento_req = $row['laikas'];
				$kliento_vardas = $row['klientas'];
				mysqli_query($db,"INSERT INTO priimti (kid,klientas, aptarnavo,reg) VALUES ('$klientas','$kliento_vardas','$specialistas','$kliento_req')");
				mysqli_query($db,"DELETE FROM klientas WHERE id = '$klientas'");
				header("location: admin.php?id=klientai");				
			}

			}
		}
	}
}
else
{
?>
<form action="admin.php?id=login" method="post">
<label>Įveskite specialisto vardą: 
<input type=text name="name" autocomplete="off" pattern="[a-žA-Ž]+" required placeholder="Specialisto vardas"></input></label>
<button>Prisijungti</button><br>
<?	
}
?>
</body>
</html>