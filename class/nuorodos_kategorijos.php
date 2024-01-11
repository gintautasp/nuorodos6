<?php

	class NuorodosKategorijos extends ModelDbIrasas {
	
		public  $id_nuorodos, $id_kategoriju;
		
		public function __construct ( $id_nuorodos, $id_kategoriju ) {
		
			parent::__construct();
		
			$this -> id_nuorodos = $id_nuorodos;
			$this -> id_kategoriju = $id_kategoriju;
		}
		
		public function issaugotiDuomenuBazeje() {
		
			$this -> salinti();
			
			$glue =  '), (' . $this -> id_nuorodos . ', ';
																														// echo '-:' . $glue . ':<BR>';
			$uzklausa =
					"
				INSERT INTO `nuorodos_kategorijos` ( `id_nuorodos`, `id_kategorijos` ) VALUES(

					" . $this -> id_nuorodos . ', ' . implode ( $glue,  $this -> id_kategoriju ) . "
				)
					";
																														//  echo $uzklausa;
			$this -> db -> uzklausa ( $uzklausa );
		}
		
		public function salinti() {

			$uzklausa =
					"
				DELETE  FROM 
					`nuorodos_kategorijos` 
				WHERE 
					`id_nuorodos`=" . $this -> id_nuorodos . "
					";
																														//  echo $uzklausa;
			$this -> db -> uzklausa ( $uzklausa );
		}
		
		public function salintiPagalKategorija() {

			$uzklausa =
					"
				DELETE  FROM 
					`nuorodos_kategorijos` 
				WHERE 
					`id_kategorijos`=" . $this -> id_kategoriju . "
					";
																														//  echo $uzklausa;
			$this -> db -> uzklausa ( $uzklausa );
		}		
	}