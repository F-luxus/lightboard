<!DOCTYPE html>
<html>
<head>
<title>Specialisto puslapis</title>
<link rel="stylesheet" href="css/styles.css">
<link rel="icon" href="favicon.ico" type="image/x-icon" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
<div class=turinys>
<?php
include("config.php");
$info = new User();
if (!isset($_GET['id'])){
    echo '
    <form action="admin.php?id=login" method="post">
    <label>Įveskite specialisto vardą: 
    <input type=text name="name" autocomplete="off" pattern="[a-žA-Ž]+" required placeholder="Specialisto vardas"></input></label>
    <button>Prisijungti</button><br>
    ';    
}
elseif ($_GET['id'] == 'login' ) {
    
    if (is_numeric($info->checkName($_POST['name']))) {
    $_SESSION["specialistas"] = $_POST['name'];
    header("location: admin.php?id=klientai");
    }    
}
elseif ($_GET['id']== "klientai") {
    
    
    if(isset($_SESSION["specialistas"])) {
        echo "<b><font>Laukiantys klientai:</b> <br>";
        $m = mysqli_query($db,"SELECT * FROM klientas ORDER BY laukimo_laikas ASC");
        $n = mysqli_query($db,"SELECT * FROM klientas ORDER BY laukimo_laikas ASC");
        while ($row = mysqli_fetch_assoc($m)) { 
            $klientas = $row['id'];
            $info->getUserData($klientas); 
            $laikas = $row['registracija'];
            $k = $row['id'];
            if($info->priimtas == 0 and $info->aptarnautas == 0) {
                echo "Klientas <b>$info->klientas</b><br>Laukia nuo <b>$laikas</b> <a href='admin.php?id=klientai&klientas=$k'>[priimti]</a><br><br>";
            }

        }
        echo "<b><font>Priimti klientai:</b> <br>";
        while ($row = mysqli_fetch_assoc($n)) { 
            $klientas = $row['id'];
            $info->getUserData($klientas); 
            $laikas = $row['registracija'];
            $k = $row['id'];
            if($info->priimtas != 0 and $info->aptarnautas == 0) {
                echo "Klientas <b>$info->klientas</b> <a href='admin.php?id=klientai&klientas=$k'>[atleisti]</a><br>";
            }

        }        
        if(isset($_GET['klientas'])) {
            $infoo = new User();
            $infoo->getUserData($_GET['klientas']);
            if(is_numeric($_GET['klientas'])) {             
                if($infoo->priimtas == 0) {
                    $klientas = $_GET['klientas'];
                    $specialistas = $infoo->checkName($_SESSION["specialistas"]);
                    $kliento_aptarnavimas = date('Y-m-d H:i:s');
                    mysqli_query($db,"UPDATE klientas SET priimtas = '$kliento_aptarnavimas' WHERE id = $klientas");
                    mysqli_query($db,"UPDATE klientas SET sid = '$specialistas' WHERE id = $klientas");
                    header("location: admin.php?id=klientai");
                }
                elseif($infoo->priimtas != 0) {
                    $klientas = $_GET['klientas'];
                    $kliento_aptarnavimas = date('Y-m-d H:i:s');
                    mysqli_query($db,"UPDATE klientas SET aptarnautas = '$kliento_aptarnavimas' WHERE id = $klientas");
                    $specialistas = $infoo->checkName($_SESSION["specialistas"]);
                    $infoo->getUserData($klientas); 
                    $reg = explode(" ",$infoo->registracija);
                    $aptarnavimas = strtotime($infoo->aptarnautas)-strtotime($infoo->priimtas);
                    $laukimas = strtotime($infoo->priimtas)-strtotime($infoo->registracija);    
                    mysqli_query($db,"INSERT INTO statistika (aptarnavo,klientas,registracijos_data,registracijos_laikas ,laukimas,aptarnavimas) VALUES ('$specialistas','$klientas','$reg[0]','$reg[1]','$laukimas','$aptarnavimas')");
                    $n = mysqli_query($db,"SELECT * FROM statistika");
                    $i = 0;    
                    $suma = 0;    
                    while ($row = mysqli_fetch_assoc($n)) {
                    $suma +=$row['aptarnavimas'];
                    $i++;
                    }
                    $dabar = time();
                    $row = mysqli_fetch_assoc(mysqli_query($db,"SELECT vidurkis FROM vidurkis WHERE id = '1'"));
                    $kliento_vidurkis = round($suma/$i)-$row['vidurkis'];
                    $vidurkis = round($suma/$i);
                    mysqli_query($db,"UPDATE vidurkis SET vidurkis = '$vidurkis' WHERE id = 1");
                    $mz = mysqli_query($db,"SELECT * FROM klientas");    
                    while ($row = mysqli_fetch_assoc($mz)) {
                    $kid = $row['id'];    
                    $laikas = $row['laukimo_laikas'];
                    $pakeitimas = $laikas+($kliento_vidurkis);
                    mysqli_query($db,"UPDATE klientas SET laukimo_laikas = '$pakeitimas' WHERE id = $kid, aptarnautas=0");    
                    }
                    header("location: admin.php?id=klientai");
                
                }
                    
            }
        }
    }
    else {
        header("location: index.php");
    }
}
else {
    header("location: index.php");
}
?>
</body>
</html>