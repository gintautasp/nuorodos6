<!DOCTYPE html>
<html>
<head>
       <meta charset="utf-8">
       <title> Nuorodų katalogo projektas</title>
       <style>
		#kategorijos {
			float: right;
			margin-right: 25px;
			width: 500px;
		}
		li {
			padding: 7px;
		}
		input[type=button] {
			width: 50px;
			margin: 7px;
		}
		input[type=submit] {
			width: 120px;		
			margin: 7px;
			float: right;
			margin-right: 25px;
			padding: 7px;
		}
		#nauja_nuoroda {
			width: 600px;
			margin-left: 12px;
		}
		label {
			display: block;
			margin-top: 12px;
		}
		label, input[type=url], input[type=text], textarea {
			width: 100%;
			padding: 7px;			
		}
		.privaloma {
			color: red;
		}
       </style>
</head>
<body>
<?php

	foreach ( $nuorodu_katalogas -> pranesimai as $pranesimas ) {
	
		echo $pranesimas . '<br>';
	}

	if ( $nuorodu_katalogas -> arPasirinktaKategorija() ) {
	
		echo 'kategorija nr.: ' . $nuorodu_katalogas -> id_kategorijos;
	}
?>
<div id="kategorijos">
<ul>
<?php
	 
	 foreach ( $nuorodu_katalogas ->  kategorijos -> sarasas as $kategorija ) {
?>	 
	<li><input type="checkbox" form="naujos_nuorodos_forma" name="kategorijax[]" value="<?= $kategorija [ 'id' ] ?>"><input type="button" value="&#9998;"><input type="button" value="&#10008;"><a href="?ikat=<?= $kategorija [ 'id' ] ?>"><?= $kategorija [ 'pav' ] ?></a></li>
<?php	 
	 }
?>	
</ul>
<div id="nauja_kategorija">
	<form method="POST" action="">
		<label for="kategorija"><span class="privaloma">*</span>Nauja kategorija</label>
		<input type="text" name="kategorija" id="kategorija">
		<input type="submit" name="sukurti" value="sukurti">
	</form>		
</div>
</div>
<h2>Nuorodų katalogas </h2>
<ul>
<?php
	 
	 foreach ( $nuorodu_katalogas ->  nuorodos -> sarasas as $nuoroda ) {
?>
	<li><input type="button" value="&#9998;"><input type="button" value="&#10008;"><a href="<?= $nuoroda [ 'nuoroda' ] ?>" title="<?= $nuoroda [ 'aprasymas' ] ?>"><?= $nuoroda [ 'pav' ] ?></a></li>
<?php	 
	 }
?>
</ul>
<?php

	if ( $nuorodu_katalogas -> arPasirinktaKategorija() ) {
?>
<div id="nauja_nuoroda">
	<form method="POST" action="" id="naujos_nuorodos_forma">
		<label><span class="privaloma">*</span>Nuoroda</label>
		<input type="url" required name="nuoroda" id="nuoroda">
		<label>Pavadinimas</label>
		<input type="text" name="pav" id="pav">
		<label>Aprašymas</label>
		<textarea name="aprasymas" id="aprasymas"></textarea>		
		<input type="submit" name="saugoti" value="išsaugoti">
	</form>		
</div>
<?php
	}
?>
</body>
</html> 