<?php

class User {
        public $kodas;
        public $name, $kelintas, $kelintas1, $max, $kuris, $vardas;
        public $klientas, $registracija, $laukimas, $aptarnautas, $priimtas, $specialistas;
        public function create() {
            global $db;
            $row = mysqli_fetch_assoc(mysqli_query($db,"SELECT vidurkis FROM vidurkis WHERE id = '1'"));
            $vidurkis = $row['vidurkis'];    
            $laikas = time()+((mysqli_num_rows(mysqli_query($db,"SELECT id FROM klientas ORDER BY registracija ASC"))+1)*$vidurkis);
            $name = $_POST['name'];
            $kodas = ((time()*2)/3)+4;
            
            $kliento_reg = date('Y-m-d H:i:s');
            mysqli_query($db,"INSERT INTO klientas (klientas,registracija,kodas,laukimo_laikas) VALUES ('$name', '$kliento_reg', '$kodas', '$laikas')");
            $row = mysqli_fetch_assoc(mysqli_query($db,"SELECT id FROM klientas WHERE klientas = '$name' and registracija = '$kliento_reg'"));
            $kid = $row['id'];    

            $this->kodas=$kodas;
            $this->id=$kid;
        
        }
        
        public function getUserData($id) {
            global $db;
            if( is_numeric($id)){
                $r=mysqli_query($db,"SELECT * FROM klientas WHERE id = '$id'"); 
                while($row = mysqli_fetch_array($r)) {
                $this->klientas = $row['klientas'];
                $this->registracija = $row['registracija'];
                $this->kodas = $row['kodas'];
                $this->laukimas = $row['laukimo_laikas'];
                $this->aptarnautas = $row['aptarnautas'];
                $this->priimtas = $row['priimtas'];
                $this->specialistas = $row['sid'];
                }    
            }
        }
        
        public function getUserRowNumber($id) {
            global $db;
            $i =1;
            $m = mysqli_query($db,"SELECT id,klientas FROM klientas where priimtas = 0 and aptarnautas =0 order by registracija ASC");    
            while ($row = mysqli_fetch_assoc($m)) {
                if($row['id'] == $id) {
                $this->kelintas=$i;
                }
            $i++;
            }
            $this->max=$i-1;
        }
        public function getUserByRowNumber($id) {
            global $db;
            $i =1;
            $m = mysqli_query($db,"SELECT id,klientas FROM klientas where priimtas = 0 and aptarnautas =0 order by registracija ASC");    
            while ($row = mysqli_fetch_assoc($m)) {
                if($i == $id) {
                $this->kelintas1=$row['id'];
                $this->vardas=$row['klientas'];
                }
            $i++;
            }
            $this->max=$i-1;
        }
        
        public function checkName($vardas) {    
            global $db;    
            $resu0="SELECT * FROM specialistai where vardas='$vardas'";
            $req0=mysqli_query($db,$resu0);
            while( $raw0=mysqli_fetch_assoc($req0)) {
                return $raw0['id'];
            }        
        }
}