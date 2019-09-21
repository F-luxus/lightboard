<!DOCTYPE html>
<html>
<head>
<title>Aptarnavimo statistika</title>
<link rel="stylesheet" href="css/styles.css">
<link rel="icon" href="favicon.ico" type="image/x-icon" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
<div class=turinys>
<?php
include("config.php");
$re = mysqli_fetch_assoc(mysqli_query($db,"SELECT vidurkis FROM `vidurkis` where id = '1' "));
$vilaukimas = $re['vidurkis'];
echo "Vidutiniškai vieno kliento aptranavimo laikas yra:<br> <b>".laikas($vilaukimas)."</b><br>";
echo "<br>";
echo "Specialistai: <br>";
$statistika = new Data();
 
$n = mysqli_query($db,"SELECT * FROM statistika GROUP BY aptarnavo order by count(*) ASC");
while ($row = mysqli_fetch_assoc($n)) {
$id = $row['aptarnavo'];	
$statistika->getTime($id);
$laikas = laikas($statistika->aptarnavimas);
echo "<b>$statistika->sname</b> aptarnavo <b>$statistika->klientai</b> klientų(-us) per <b>$laikas</b>, o vieno asmens vizitas trunka <b>$statistika->vidurkis</b><br>";


	
}

?>
</div>
</body>
</html>

