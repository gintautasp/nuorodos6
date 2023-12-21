<?php

	$main_dir = __DIR__ .  '/';
	
	include 'conf.php';
	
	include $conf [ 'dir_bendra' ] . 'duomenu_baze.class.php';
	include  $conf [ 'dir_bendra' ] . 'model_db.class.php';
	include  $conf [ 'dir_bendra' ] . 'model_db_irasas.class.php';
	include  $conf [ 'dir_bendra' ] . 'model_db_sarasas.class.php';	

	$db = new DuomenuBaze ( $conf [ 'name_db' ], $conf [ 'name_user_db' ], $conf [ 'password_user_db' ] );
	
	if ( isset ( $_GET [ 'g1n' ] ) && ( $id_nuorodos =  $_GET [ 'g1n' ] ) ) {
	
		include 'gauti-nuoroda.php';

		die;
	}
	
	include $conf [ 'dir_bendra' ] . 'controller.class.php';
	include $main_dir . 'class/nuorodu_katalogas.php';
	include $main_dir . 'class/kategorija.php';	
	include $main_dir . 'class/kategorijos.php';	
	include $main_dir . 'class/nuoroda.php';
	include $main_dir . 'class/nuorodos_kategorijos.php';	
	include $main_dir . 'class/nuorodos.php';	

	$nuorodu_katalogas = new NuoroduKatalogas( $main_dir );				// nuorodų katalogo, kaip objekto sukūrimas
	
	if ( $nuorodu_katalogas -> arSukurtiNaujaKategorija() ) {
	
		$nuorodu_katalogas -> sukurtiNaujaKategorija();
	}

	if ( $nuorodu_katalogas -> arKoreguotiKategorija() ) {
	
		$nuorodu_katalogas -> koreguotiKategorija();
	}
	
	if ( $nuorodu_katalogas -> arSalintiKategorija() ) {
	
		$nuorodu_katalogas -> salintiKategorija();
	}
	
	if ( $nuorodu_katalogas -> arItraukiamaNaujaNuoroda() ) {
	
		$nuorodu_katalogas -> itrauktiNuoroda();
	}

	if ( $nuorodu_katalogas -> arKoreguojamaNuoroda() ) {
	
		$nuorodu_katalogas -> koreguotiNuoroda();
	}
	
	if ( $nuorodu_katalogas -> arSalinamaNuoroda() ) {
	
		$nuorodu_katalogas -> salintiNuoroda();
	}	
	
	$nuorodu_katalogas -> gautiDuomenis();
	
	include 'view.php';
	
	
	
	