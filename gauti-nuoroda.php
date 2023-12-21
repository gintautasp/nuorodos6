<?php
	
	include $main_dir . 'class/nuoroda.php';
	
	$nuoroda = new Nuoroda();
	
	echo json_encode ( $nuoroda -> gauti1Nuoroda ( $id_nuorodos ) );