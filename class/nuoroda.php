<?php

	class Nuoroda extends ModelDbIrasas {
	
		public $id, $nuoroda, $pav, $kategorijos, $aprasymas;
		
		public function __construct( $nuoroda, $pav,  $aprasymas ) {
		
			$this -> nuoroda = $nuoroda;
			$this -> pav = $pav;
			$this -> aprasymas = $aprasymas;
		
			parent::__construct();
		}
		
		public function arYraTokiaNuoroda () {

			$yra = false;
			
			$uzklausa =
					"
				SELECT * FROM `nuorodos` WHERE `nuoroda`='" . $this -> nuoroda . "'
					";

			// echo $uzklausa;
			
			$nuorodu_saraso_resursas = $this -> db -> uzklausa ( $uzklausa );
			
			if ( $gauta_nuoroda =  mysqli_fetch_assoc ( $nuorodu_saraso_resursas ) ) {
			
				$this -> id = $gauta_nuoroda [ 'id' ]; 

				$yra = true;
			}
			return $yra;
		}		
		
		public function issaugotiDuomenuBazeje() {
			
			$uzklausa =
"
				INSERT INTO `nuorodos` ( `nuoroda`, `pav`, `aprasymas` ) VALUES(
					'" . $this -> nuoroda . "'
					, '" . $this -> pav . "'
					, '". $this-> aprasymas . "'
				)
					";
																														// echo $uzklausa;
			$this -> db -> uzklausa ( $uzklausa, 'last_insert_id' );

			$this -> id = $this -> db -> last_insert_id;
		}
	}
	