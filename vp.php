<!DOCTYPE html>
<html>
<head>
<title>Kliento valdymo panelė</title>
<link rel="stylesheet" href="css/styles.css">
<link rel="icon" href="favicon.ico" type="image/x-icon" />
<meta http-equiv="refresh" content="5">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

</head>
<body>
<div class=turinys>
<?php



include("config.php");

if(isset($_GET['klientas']) and isset($_GET['kodas']) ) {
    $klientas = $_GET['klientas'];
    $info = new User();
    $info->getUserData($_GET['klientas']); 
    $info->getUserRowNumber($_GET['klientas']); 

    
    if ($_GET['kodas'] == $info->kodas) {
        $laukimas =$info->laukimas-time();
        if(empty($info->kelintas)) {
        echo "Ačiū,<b>$info->klientas</b>, kad naudojatės mūsų paslaugomis.<br>";    
        }
        elseif($laukimas > 0) {
        echo "Sveiki,<b>$info->klientas</b> , Jūsų apytikslis laukimo laikas pas specialistą yra :  <b>".laikas($laukimas)."</b><br>";  
		echo "Jūs esate eilėje $info->kelintas iš $info->max<br>";		
        }
        elseif($laukimas < 0) {
        echo "Sveiki,<b>$info->klientas</b>, artimiausiu metu, jus pakviesime<br>";   
		echo "Jūs esate eilėje $info->kelintas iš $info->max<br>";		
        }
        
        echo "<a href='laukia.php'>[Grįžti į švieslentę]</a> ";    
        echo "<a href='vp.php?klientas=$klientas&kodas=$info->kodas&v=trinti'>[Atšaukti apsilankymą]</a> ";
        
        
 
        if ($info->max > $info->kelintas) {
        $asmuo = $info->kelintas+1;
        $info1 = new User();

        $info1->getUserByRowNumber($asmuo);
        echo "<a href='vp.php?klientas=$klientas&kodas=$info->kodas&v=velinti&kuo=$info1->kelintas1'>[Pavėlinti apsilankymą]</a>";
        }
        
//Atšaukti apsilankymą
        if (isset($_GET['v']) and $_GET['v']== "trinti") {
            mysqli_query($db,"DELETE FROM klientas WHERE id = '$klientas'");
            header("location: index.php");            
        }
//Atlikti keitimą
        if (isset($_GET['v']) and $_GET['v']== "velinti") {
            if($info->max == $info->kelintas ) {
                echo "<br><b>Vėlinimas negalimas, esate paskutinis eilėje.</b>";
            }
        else {
            $klientas = $_GET['klientas'];
            $keitejas = $_GET['kuo'];
            $patikrinimas = $_GET['kuo']-1;
            if ($keitejas != $info1->kelintas1) {
                echo "<br><b>Keitimas negalimas</b>";
            }
            else {
                
                $info1->getUserData($keitejas);
                $pirmas[0] = $info->laukimas;
                $pirmas[1] = $info->registracija;
                $pirmas[2] = $info->klientas;
                $pirmas[3] = $info->kodas;
                
                $antras[0] = $info1->laukimas;
                $antras[1] = $info1->registracija;
                $antras[2] = $info1->klientas;
                $antras[3] = $info1->kodas;
                

                mysqli_query($db,"UPDATE klientas SET registracija='$antras[1]', laukimo_laikas = '$antras[0]' WHERE id = '$klientas'");
                mysqli_query($db,"UPDATE klientas SET registracija='$pirmas[1]', laukimo_laikas = '$pirmas[0]' WHERE id = '$keitejas'");
                header("location: vp.php?klientas=$klientas&kodas=$pirmas[3]");
            }
        }    
        }        
    }
    else {
                
    }
    
}
?>
</div>
</body>
</html>


