<!DOCTYPE html>
<html>
<head>
<title>Aptarnavimo statistika</title>
<link rel="stylesheet" href="css/styles.css">
</head>
<body>

<?php
include("config.php");
$re = mysqli_fetch_assoc(mysqli_query($db,"SELECT vidurkis FROM `vidurkis` where id = '1' "));
$vilaukimas = $re['vidurkis'];
echo "Vidutiniškai vieno kliento aptranavimo laikas yra: $vilaukimas sek.";

?>

</body>
</html>

