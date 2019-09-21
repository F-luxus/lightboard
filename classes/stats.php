<?php

class Data {
	public $aptarnavimas, $klientai, $sname, $vidurkis;
	public function getTime($id){
		
		if(is_numeric($id)){
			global $db;
			$i = 0;
			$suma =0;
			$n = mysqli_query($db,"SELECT * FROM statistika where aptarnavo = $id");
            while ($row = mysqli_fetch_assoc($n)) {

				$suma +=$row['aptarnavimas'];
				$i++;
            }
			$row = mysqli_fetch_assoc(mysqli_query($db,"SELECT vardas FROM specialistai WHERE id = '$id'"));
			$sname = $row['vardas'];
			$vidurkis = round($suma/$i);
			$this->aptarnavimas=$suma;
			$this->klientai=$i;
			$this->sname=$sname;
			$this->vidurkis=laikas($vidurkis);
		}
	}

}