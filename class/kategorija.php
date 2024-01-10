<?php

	class Kategorija extends ModelDbIrasas {
	
		public $id, $pav;    																	// čia reiktu pasipildyti !

		public function __construct( $kategorija, $id = 0 ) {
		
			parent::__construct();
			$this -> pav = $kategorija;
			$this -> id = $id;
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
			
			if ( $this -> id == 0 ) {			
			
				$uzklausa =
						"
					INSERT INTO `kategorijos` (  `pav` ) VALUES(
						'" . $this -> pav . "'
					)
						";
																															// echo $uzklausa;
				$this -> db -> uzklausa ( $uzklausa, 'last_insert_id' );

				$this -> id = $this -> db -> last_insert_id;	
				
			} else {
			
				$uzklausa =
						"
					UPDATE `kategorijos` SET
						`pav`= '" . $this -> pav . "'
					WHERE
						`id`= " . $this -> id . "
						";
																															// echo $uzklausa;
				$this -> db -> uzklausa ( $uzklausa, 'afected_rows' );				
			}
		}
	}