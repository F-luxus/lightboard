<!DOCTYPE html>
<html>
<head>
<title>Registracija pas specialistą</title>
<link rel="stylesheet" href="css/styles.css">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>

<?php
include("config.php");
$error = false ;
?>
<form action="/" method="post">
<label>Įveskite savo vardą: 
<input type=text name="name" autocomplete="off" pattern="[a-ž A-Ž]+" required placeholder="Kliento vardas"></input></label>
<button>Stoti į eilę</button>
<?php
if (isset($_POST['name'])) {
    $min_name_lenght = 3;
	if (strlen($_POST['name']) < $min_name_lenght or preg_match('/[^a-ž A-Ž\d]/', $_POST['name'])) {
		$error = true;
		echo "Įvyko klaida, kreipkitės telefonu";
	}
	elseif ($error != true) {
		$row = mysqli_fetch_assoc(mysqli_query($db,"SELECT * FROM `vidurkis` WHERE id = '1'"));
		$vidurkis = $row['vidurkis'];	
		$laikas = time()+((mysqli_num_rows(mysqli_query($db,"SELECT * FROM klientas ORDER BY laikas ASC"))+1)*$vidurkis);
		$name = $_POST['name'];
		
		$kodas = ((time()*2)/3)+4;
		mysqli_query($db,"INSERT INTO laukimo_laikas (klientas,laukimas) VALUES ('$name','$laikas')");
		$kliento_aptarnavimas = date('Y-m-d H:i:s');
		mysqli_query($db,"INSERT INTO klientas (klientas,laikas) VALUES ('$name','$kliento_aptarnavimas')");
		mysqli_query($db,"INSERT INTO vp (klientas,kodas) VALUES ('$name','$kodas')");
		$name = str_replace(" ","%20",$name);
		echo "Užregistruota sėkmingai.<br>Vartotojo panelės adresas: <a href=http://nfq-siauliai.us.lt/vp.php?klientas=$name&kodas=$kodas>[čia]</a>";
		//header("location: /laukia.php");
	
	}
	
}
echo "<br>";
echo "<a href='laukia.php'>[Laukimo ekranas]</a><br>";
echo "<a href='admin.php'>[Specialisto VP]</a><br>";

?>

</body>
</html>



