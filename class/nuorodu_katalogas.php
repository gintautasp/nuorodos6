<?php

	class NuoroduKatalogas extends Controller {
	
		public $main_dir, $nuoroda, $id_kategorijos = 0, $pranesimai = array(), $kategorijos;
	
		public function __construct( $main_dir ) {
		
			$this -> main_dir = $main_dir;
			
			if ( isset ( $_GET [ 'ikat' ] ) ) {
			
				$this -> id_kategorijos = $_GET [ 'ikat' ];
			}			
		
			parent::__construct();
		}
		
		public function arPasirinktaKategorija() {
		
			$ar_pasirinkta_kategorija = false;
			
			if ( $this -> id_kategorijos > 0 ) {
			
				$ar_pasirinkta_kategorija = true;
			}
		
			return $ar_pasirinkta_kategorija;
		}
		
		public function arItraukiamaNaujaNuoroda(){
			
			$saugoti = false;
		
			if ( isset ( $_POST [ 'saugoti' ] ) && ( $_POST [ 'saugoti' ] =="išsaugoti" ) ) {
			
				$saugoti = true;
																														//	echo 'saugoti';
			}
			return $saugoti;
		}

		public function itrauktiNuoroda() {
		
			if ( isset ( $_POST [ 'nuoroda' ] ) &&  ( $_POST [ 'nuoroda' ] != '' ) && ( strlen (  $_POST [ 'nuoroda' ] ) > 2 ) ) {
		
				$nuoroda = new Nuoroda( $_POST [ 'nuoroda' ], $_POST [ 'pav' ], $_POST [ 'aprasymas' ] );
				
				if ( $nuoroda -> arYraTokiaNuoroda() ) {
			
					$this -> pranesimai[] = 'tokia nuoroda jau yra';
					
				} else {
				
					$this -> pranesimai[] = 'nuoroda saugoma ..';

					 $nuoroda ->  issaugotiDuomenuBazeje();
					 
					$this -> pranesimai[] = 'nuoroda išsaugota, nuorodos id: ' . $nuoroda -> id;

					if ( $nuoroda -> id > 0 ) {
					
						if ( isset ( $_POST [ 'kategorijax' ] ) ) {
					
							$kategorijos = $_POST [ 'kategorijax' ];
							
						} else {
						
							$kategorijos = array();
						}
						
						$kategorijos[] = $this -> id_kategorijos;

						$this -> pranesimai[] = 'saugomos nuorodos kategorijos ..';
					
						$nuorodos_kategorijos = new NuorodosKategorijos ( $nuoroda -> id, $kategorijos );
						
						 $nuorodos_kategorijos -> issaugotiDuomenuBazeje();
						 
						$this -> pranesimai[] = 'nuorodos kategorijos i6saugotos';						 
					}
				}
				
			} else {
			
				$this -> pranesimai[] = 'netinkamas nuoroda pavadinimas';
			}
		}

		public function arKoreguojamaNuoroda() {
		
			return false;
		}
		
		public function koreguotiNuoroda() {

		}
		
		public function arSalinamaNuoroda() {
		
			return false;
		}
	
		public function salintiNuoroda() {

		}
		
		public function gautiDuomenis() {
		
			$this -> kategorijos = new Kategorijos();
			
			$this -> kategorijos -> gautiSarasaIsDuomenuBazes();
			
			$this -> nuorodos = new Nuorodos();
			
			if ( $this -> arPasirinktaKategorija() ) {
			
				$this -> nuorodos -> pasirinktiKategorija ( $this -> id_kategorijos );
			}
			
			$this -> nuorodos -> gautiSarasaIsDuomenuBazes();
		}
		
		public function arSukurtiNaujaKategorija() {
			
			$ar_sukurti_nauja_kategorija = false;
		
			if ( isset ( $_POST [ 'sukurti' ] ) && ( $_POST [ 'sukurti' ]=='sukurti' ) ) {
		
				$ar_sukurti_nauja_kategorija = true;
			}
			return $ar_sukurti_nauja_kategorija;
		}
	
		public function sukurtiNaujaKategorija() {
		
			if ( isset ( $_POST [ 'kategorija' ] ) &&  ( $_POST [ 'kategorija' ] != '' ) && ( strlen (  $_POST [ 'kategorija' ] ) > 2 ) ) {
		
				$kategorija = new Kategorija( $_POST [ 'kategorija' ] );
				
				if ( $kategorija -> arYraTokiaKategorija() ) {
			
					$this -> pranesimai[] = 'tokia kategorija jau yra';
					
				} else {
				
					$this -> pranesimai[] = 'kategorija saugoma ..';

					 $kategorija ->  issaugotiDuomenuBazeje();
					 
					$this -> pranesimai[] = 'kategorija išsaugota';					 
				}
				
			} else {
			
				$this -> pranesimai[] = 'netinkamas kategorijos pavadinimas';
			}
		}

		public function arKoreguotiKategorija() {
			
			return false;
		}
	
		public function koreguotiKategorija() {
		
		}
		
		public function  arSalintiKategorija() {
		
			return false;
		}
		
		public function salintiKategorija() {
		
		}
	}
