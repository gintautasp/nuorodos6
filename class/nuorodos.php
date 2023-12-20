<?php

	class Nuorodos extends ModelDbSarasas {
	
		public $paieskos_tekstas = '', $ieskoti_pagal = array(), $kategorijos_id = 0;
		
		public function __construct() {
		
			parent::__construct();
		}
		
		public function nustatytiPaieskosReiksmes( $paieskos_tekstas, $ieskoti_pagal ) {
		
			$this -> paieskos_tekstas = $paieskos_tekstas;
			
			$this -> ieskoti_pagal = array_values (  $ieskoti_pagal );
																									// print_r ( $this -> ieskoti_pagal  );
		}
		
		public function pasirinktiKategorija ( $kategorijos_id ) {
		
			$this -> kategorijos_id = $kategorijos_id;
		}
	
		public function gautiSarasaIsDuomenuBazes() {
			
			$uzklausa =
					"
				SELECT 
					`nuorodos`.*
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
						1
					";
			
			if ( intval ( $this -> kategorijos_id ) > 0 ) {
				
				$uzklausa .= 
					"
					AND
						`nuorodos_kategorijos`.`id_kategorijos`=" . $this -> kategorijos_id . "
					";
			}
			
			if ( ( $this -> paieskos_tekstas != '' ) && ( $this -> ieskoti_pagal ) ) {
			
					$prideti_or = '';
					
					$uzklausa .=
							"
						AND (	
							";
			
					if ( in_array ( 'url', $this -> ieskoti_pagal ) ) {
					
						$uzklausa .= 
							"
								`nuorodos`.`nuoroda` LIKE( '%" . $this -> paieskos_tekstas . "%' )
							";
						$prideti_or = 'OR';
					}
				
					if ( in_array ( 'pav', $this-> ieskoti_pagal ) ) {
					
						$uzklausa .= 
							"
							" . $prideti_or . "
								`nuorodos`.`pav` LIKE( '%" . $this ->paieskos_tekstas . "%' )
							";
						$prideti_or = 'OR';							
					}	
			
					if ( in_array ( 'kat', $this -> ieskoti_pagal ) ) {
					
						$uzklausa .= 
							"
							" . $prideti_or . "
								`kategorijos`.`pav` LIKE( '%" . $this -> paieskos_tekstas . "%' )
							";					
					}
					$uzklausa .=
							"
						)	
							";					
			}
			
			$uzklausa .= 
					"			
				GROUP BY
					`nuorodos`.`id`
					";
																														// echo $uzklausa;
			$nuorodu_saraso_resursas = $this -> db -> uzklausa ( $uzklausa );
			
			while ( $nuoroda =  mysqli_fetch_assoc ( $nuorodu_saraso_resursas ) ) {

				$this -> sarasas[] = $nuoroda;
			}
		}
	}