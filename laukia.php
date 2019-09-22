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
$info = new User();
$info->getUserByRowNumber('1');
$info->getUserData($info->kelintas1);
$laukimo = ($info->laukimas)-time();
if(empty($info->laukimas)) {
    echo "<center><div class=digital>Niekas nelaukia - galite <a href='index.php'>registruotis</a></div></center><br>";
}
elseif($laukimo  >0) {
    echo "<center><div class=digital>$info->klientas - numatomas vizitas po ".laikas("$laukimo")."</div></center><br>"; 
    echo "<div class=sarasas><div class=h1><center>Laukiantys eilėje</center></div><br>";
}
elseif($laukimo  <0) {
    echo "<center><div class=digital>$info->klientas - netrukus pakviesime</div></center><br>";
    echo "<div class=sarasas><div class=h1><center>Laukiantys eilėje</center></div><br>";
}
$m = mysqli_query($db,"SELECT * FROM klientas where sid='0' ORDER BY laukimo_laikas ASC LIMIT 5");    
$l = 1;
while ($row = mysqli_fetch_assoc($m)) {
    $klientas = $row['klientas'];
    $kliento_id = $row['id'];
    if($l >1) {
        $i = $l;
        echo "<b>$i.</b> $klientas<br>";        
    }
    $l++;        
}
echo "</div>";

?>

</body>
</html>


