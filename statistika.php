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

echo "Vidutiniškai vieno kliento aptranavimo laikas yra:".laikas($vilaukimas);

?>
</div>
</body>
</html>

