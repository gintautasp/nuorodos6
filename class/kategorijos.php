<?php

	class Kategorijos extends ModelDbSarasas{
		
		public function __construct() {
		
		}		
	
		public function gautiSarasaIsDuomenuBazes() {
		
			global $db;
			
			$uzklausa =
					"
				SELECT * FROM `kategorijos`
					";

			// echo $uzklausa;
			
			$nuorodu_saraso_resursas = $db -> uzklausa ( $uzklausa );
			
			while ( $nuoroda =  mysqli_fetch_assoc ( $nuorodu_saraso_resursas ) ) {

				$this -> sarasas[] = $nuoroda;
			}
		}
	}