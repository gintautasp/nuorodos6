<!DOCTYPE html>
<html>
<head>
       <meta charset="utf-8">
       <title> Nuorodų katalogo projektas</title>
       <style>
		#kategorijos {
			float: right;
			margin-right: 12px;
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
		}
       </style>
</head>
<body>
<div id="kategorijos">
<ul>
	<li><a href="?ikat=1">Duomenų bazės</a></li>	
	<li><a href="?ikat=2">Marketingas</a></li>
</ul>	
</div>
<h2>Nuorodų katalogas </h2>
<ul>
	<li><input type="button" value="&#9998;"><input type="button" value="&#10008;"><a href="https://www.programva.com/lt/testai-egzaminai-klausimai-atsakymai">Testai, egzaminai, klausimai, atsakymai</a></li>
	<li><input type="button" value="&#9998;"><input type="button" value="&#10008;"><a href="https://dbdiagram.io/d">Use DBML to define your database structure</a></li>	
</ul>
<div id="nauja_nuoroda">
	<form method="POST" action="">
		<label>Nuoroda</label>
		<input type="url" name="nuoroda" id="nuoroda">
		<input type="submit" value="išsaugoti">
	</form>
</div>
</body>
</html> 