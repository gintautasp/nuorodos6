<?php

	class Nuoroda extends ModelDbIrasas {
	
		public $id, $nuoroda, $pav, $kategorijos, $aprasymas;
		
		public function __construct( $nuoroda = null, $pav = null,  $aprasymas = null, $id = 0 ) {
		
			$this -> nuoroda = $nuoroda;
			$this -> pav = $pav;
			$this -> aprasymas = $aprasymas;
			$this -> id = $id;
		
			parent::__construct();
		}
		
		public function gauti1Nuoroda( $id ) {
			
			$uzklausa =
					"
				SELECT 
					`nuorodos`.*
					, GROUP_CONCAT( `kategorijos`.`id`) AS `id_kategoriju`
				FROM 
					`nuorodos`
				LEFT JOIN 
					`nuorodos_kategorijos` ON (
						`nuorodos`.`id`=`nuorodos_kategorijos`.`id_nuorodos`
					)
				LEFT JOIN `kategorijos` ON (
						`nuorodos_kategorijos`.`id_kategorijos`=`kategorijos`.`id`
				)
				WHERE 
					`nuorodos`.`id`='" . $id . "'
				GROUP BY
					`nuorodos`.`id`					
					";
																														// echo $uzklausa
			$nuorodu_saraso_resursas = $this -> db -> uzklausa ( $uzklausa );
			
			$gauta_nuoroda =  mysqli_fetch_assoc ( $nuorodu_saraso_resursas );

			return $gauta_nuoroda;
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
		
			if ( $this -> id == 0 ) {
				
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
				
			} else {
			
				$uzklausa =
						"
					UPDATE `nuorodos` SET
						`nuoroda`= '" . $this -> nuoroda . "'
						, `pav`= '" . $this -> pav . "'
						,  `aprasymas`='". $this-> aprasymas . "'
					WHERE
						`id`= " . $this -> id . "
						";
																															// echo $uzklausa;
				$this -> db -> uzklausa ( $uzklausa, 'afected_rows' );		
			}
		}
		
		public function salinti( $id ) {
		
			$uzklausa =
					"
				DELETE FROM 
					`nuorodos` 
				WHERE
					`id`= " . $id . "
					";
																														// echo $uzklausa;
			$this -> db -> uzklausa ( $uzklausa, 'last_insert_id' );
		}
	}
	