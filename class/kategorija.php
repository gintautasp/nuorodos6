<?php

	class Kategorija extends ModelDbIrasas {
	
		public $id, $pav;    																	// čia reiktu pasipildyti !

		public function __construct( $kategorija ) {
		
			parent::__construct();
			$this -> pav = $kategorija;
		}
																					// sukurti reikalingu metodu antrastes
		public function arYraTokiaKategorija () {

			$yra = false;
			
			$uzklausa =
					"
				SELECT * FROM `kategorijos` WHERE `pav`='" . $this -> pav . "'
					";

			// echo $uzklausa;
			
			$kategoriju_saraso_resursas = $this -> db -> uzklausa ( $uzklausa );
			
			if ( $gauta_kategorija =  mysqli_fetch_assoc ( $kategoriju_saraso_resursas ) ) {
			
				$this -> id = $gauta_kategorija [ 'id' ]; 

				$yra = true;
			}
			return $yra;
		}
																					
		public function issaugotiDuomenuBazeje() {
			
			$uzklausa =
"
				INSERT INTO `kategorijos` (  `pav` ) VALUES(
					'" . $this -> pav . "'
				)
					";
																														// echo $uzklausa;
			$this -> db -> uzklausa ( $uzklausa, 'last_insert_id' );

			$this -> id = $this -> db -> last_insert_id;		
		}
	}