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
		input[type=submit], input[type=reset] {
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
		#result {
			display: none;
		}
		#pranesimai {
			width: auto;
		}
<?php

	if ( ! $nuorodu_katalogas -> arPasirinktaEgzistuojantiKategorija() ) {
?>
		#nauja_nuoroda {
			display: none;
		}
<?php
	}
?>
       </style>
       <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
       <script>
		$( document ).ready( function() {
		
			$( '.redaguoti_nuoroda' ).each ( function() {
			
				$( this ).click ( function() {
				
					if ( id = $( this ).data( 'id' ) ) {
																													// alert ( 'pasirinkta nuoroda id: ' +  id );
						$.get( '?g1n=' + id, function( data ) {
																													// $(  '#result' ).html ( data );
						
							nuoroda = JSON.parse ( data );
						
							$( '#nuoroda' ).val( nuoroda.nuoroda );
							$( '#pav' ).val( nuoroda.pav);
							$( '#aprasymas' ).html( nuoroda.aprasymas );
							$( '#id_nuorodos' ).val( nuoroda.id );
							
							kategoriju_id = nuoroda.id_kategoriju.split ( ',' );
							
							$( '.kat_parink' ).each ( function() {
							
								$(  '#result' ).html( $(  '#result' ).html() +',' + $( this ).val() );
							
								$( '#k'+ $( this ).val() ).prop ( 'checked', false ); 													// .removeAttr( 'checked' ); 
								// @TO_DO nuima checked reikšmę, bet nenuima rodyme 
								
								$(  '#result' ).html( $(  '#result' ).html() +',' + $( '#k'+ $( this ).val() ).prop ( 'checked' ) );
							});
							
							for ( i = 0; i< kategoriju_id.length; i++ ) {
								
								$( '#k' + kategoriju_id [ i ] ).prop ( 'checked', true );
							}

							$( '#nauja_nuoroda' ).show();																							
						});
					}
				});
			});
			
			$( '#pranesimai' ).click( function() {
			
				$( '#result' ).toggle();
			});
			
			$( '.salinti_nuoroda' ).each ( function() {
			
				$( this ).click ( function() {
				
					if ( confirm( "Ar tikrai norite pašalinti nuorodą" ) == true) {
				
						if ( id = $( this ).data( 'id' ) ) {
						
							$( '#id_salinamos_nuorodos' ).val ( id );
							$( '#salinamos_nuorodos_forma' ).submit();
						}
					}
				});
			});
			
			$( '.salinti_kategorija' ).each ( function() {
			
				$( this ).click ( function() {
				
					if ( confirm( "Ar tikrai norite pašalinti kategoriją" ) == true) {
				
						if ( id_kategorijos = $( this ).data( 'id_kategorijos' ) ) {
						
							$( '#id_salinamos_kategorijos' ).val ( id_kategorijos );
							$( '#salinamos_kategorijos_forma' ).submit();
						}
					}
				});
			});			
			
			$( '.kat_keisk' ).each( function() {
			
				$( this ).click( function() {
																									// $(  '#result' ).html( $( this ).data( 'kategorija' ) +', ' + $( this ).data( 'id_kategorijos' ) );
					$( '#id_kategorijos' ).val (  $( this ).data( 'id_kategorijos' ) );
					$( '#kategorija' ).val (  $( this ).data( 'kategorija' ) );
					$( '#kategorijos_veiksmo_pavadinimas' ).html ( 'Pervardinama kategorija' );
					$( '#kategorijos_saugojimas ' ).val ( 'pakeisti' );
				});
			});
			
			$( '#atsaukti_nuorodos_redagavima' ).click( function() {
			
				$( '#id_nuorodos' ).val ( '0' );
			});
			
			$( '#atsaukti_kategorijos_redagavima' ).click( function() {
			
				$( '#id_kategorijos' ).val ( '0' );
			});			
		});
       </script>
</head>
<body>
<input type="button" value="Pranešimai" id="pranesimai">
<div id="result">
<?php

	foreach ( $nuorodu_katalogas -> pranesimai as $pranesimas ) {
	
		echo $pranesimas . '<br>';
	}

	if ( $nuorodu_katalogas -> arPasirinktaKategorija() ) {
	
		echo 'kategorija nr.: ' . $nuorodu_katalogas -> id_kategorijos;
	}
?>
</div>
<div id="kategorijos">
<ul>
	<li>
		<input type="checkbox" form="naujos_nuorodos_forma" name="kategorijax[]" value="<?= $kategorija [ 'id' ] ?>"  id="k<?= $kategorija [ 'id' ] ?>" class="kat_parink" disabled>
		<input type="button" value="&#9998;" data-kategorija="<?= $kategorija [ 'pav' ] ?>" data-id_kategorijos="<?= $kategorija [ 'id' ] ?>"  class="kat_keisk" disabled>
		<input type="button" value="&#10008;"  class="salinti_kategorija"  data-id_kategorijos="<?= $kategorija [ 'id' ] ?>" disabled>
		<a href="?ikat=0">
			Be kategorijos
		</a>
	</li>	
<?php
	 
	 foreach ( $nuorodu_katalogas ->  kategorijos -> sarasas as $kategorija ) {
?>	 
	<li>
		<input type="checkbox" form="naujos_nuorodos_forma" name="kategorijax[]" value="<?= $kategorija [ 'id' ] ?>"  id="k<?= $kategorija [ 'id' ] ?>" class="kat_parink">
		<input type="button" value="&#9998;" data-kategorija="<?= $kategorija [ 'pav' ] ?>" data-id_kategorijos="<?= $kategorija [ 'id' ] ?>"  class="kat_keisk">
		<input type="button" value="&#10008;"  class="salinti_kategorija"  data-id_kategorijos="<?= $kategorija [ 'id' ] ?>">
		<a href="?ikat=<?= $kategorija [ 'id' ] ?>">
			<?= $kategorija [ 'pav' ] ?>
		</a>
	</li>
<?php	 
	 }
?>	
</ul>
<div id="nauja_kategorija">
	<form method="POST" action="">
		<label for="kategorija"><span class="privaloma">*</span><span id="kategorijos_veiksmo_pavadinimas">Nauja kategorija</span></label>
		<input type="text" name="kategorija" id="kategorija">
		<input type="hidden" name="id_kategorijos" id="id_kategorijos" value="0">
		<input type="submit" id="kategorijos_saugojimas" name="sukurti" value="sukurti">
		<input type="reset" id="atsaukti_kategorijos_redagavima" name="atsaukti_kategorija" value="atšaukti">		
	</form>		
</div>
</div>
<h2>Nuorodų katalogas </h2>
<ul>
<?php
	 
	 foreach ( $nuorodu_katalogas ->  nuorodos -> sarasas as $nuoroda ) {
?>
	<li>
		<input type="button" class="redaguoti_nuoroda" data-id="<?= $nuoroda [ 'id' ] ?>" value="&#9998;">
		<input type="button" class="salinti_nuoroda" data-id="<?= $nuoroda [ 'id' ] ?>" value="&#10008;">
		<a href="<?= $nuoroda [ 'nuoroda' ] ?>" title="<?= $nuoroda [ 'aprasymas' ] ?>" target="_blank">
			<?= $nuoroda [ 'pav' ] ?>
		</a>
	</li>
<?php	 
	 }
?>
</ul>
<div id="nauja_nuoroda">
	<form method="POST" action="" id="naujos_nuorodos_forma">
		<label><span class="privaloma">*</span>Nuoroda</label>
		<input type="url" required name="nuoroda" id="nuoroda">
		<label>Pavadinimas</label>
		<input type="text" name="pav" id="pav">
		<label>Aprašymas</label>
		<textarea name="aprasymas" id="aprasymas"></textarea>
		<input type="hidden" id="id_nuorodos" name="id_nuorodos" value="0">
		<input type="submit" name="saugoti" value="išsaugoti">
		<input type="reset" id="atsaukti_nuorodos_redagavima" name="atsaukti" value="atšaukti">
 	</form>		
</div>
<form method="POST" action="" id="salinamos_nuorodos_forma">
	<input type="hidden" id="id_salinamos_nuorodos" name="id_salinamos_nuorodos" value="0">
	<input type="hidden" name="salinti" value="šalinti">
</form>
<form method="POST" action="" id="salinamos_kategorijos_forma">
	<input type="hidden" id="id_salinamos_kategorijos" name="id_salinamos_kategorijos" value="0">
	<input type="hidden" name="naikinti" value="šalinti">
</form>
</body>
</html> 