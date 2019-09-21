<!DOCTYPE html>
<html>
<head>
<title>Registracija pas specialistą</title>
<link rel="stylesheet" href="css/styles.css">
<link rel="icon" href="favicon.ico" type="image/x-icon" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>

<?php
include("config.php");
$error = false ;
?>
<div class=turinys><form action="" method="post">
<label>Įveskite savo vardą: 
<input type=text name="name" autocomplete="off" pattern="[a-ž A-Ž]+" required placeholder="Kliento vardas"></input></label>
<button>Stoti į eilę</button>
</form>
<?php
if (isset($_POST['name'])) {
    $min_name_lenght = 3;
    if (strlen($_POST['name']) < $min_name_lenght or preg_match('/[^a-ž A-Ž\d]/', $_POST['name'])) {
        $error = true;
        echo "<br><font color=red>Įvyko klaida, kreipkitės telefonu</font><br>";
    }
    elseif ($error != true) {
        $user= new User();
        $user->create();
        echo "<br><font color=green>Užregistruota sėkmingai.</font><br>Vartotojo panelės adresas: <a href=vp.php?klientas=".$user->id."&kodas=".$user->kodas.">[čia]</a><br>";
    
    }
    
}
echo "<br>";
echo "<a href='laukia.php'><button>Laukimo ekranas</button></a>";
echo "<a href='admin.php'><button>Specialisto VP</button></a>";
echo "<a href='statistika.php'><button>Aptarnavimo statistika</button></a></div>";

?>

</body>
</html>



