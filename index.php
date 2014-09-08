<!DOCTYPE HTML>
<html>
<head>
	<meta charset="utf-8">
	<title>Schachfigurenbrett für Anfänger</title>
	<link rel="stylesheet" href="style.css" type="text/css" >
</head>
	
	
	<?php
	session_start();
			include './rules/bauer.php';
			include './rules/turm.php';
			include './rules/dame.php';
			include './rules/konig.php';
			include './rules/laufer.php';
			include './rules/pferd.php';
			include './rules/schach.php';
			include './rules/zuglogik.php';


		 //Funktion um PHP Funktionen zu debuggen
        function debug_to_console( $data ) {

			if ( is_array( $data ) ){
	                $output = "<script>console.log( 'Debug PHP: " . implode( ',', $data) . "' );</script>";}
			else{
	                $output = "<script>console.log( 'Debug PHP: " . $data . "' );</script>";}

			echo $output;
        }
        
        //Funktion um den Buchstaben aus einem Ascii Code zu lesen
		function unichr($u) {
		   return mb_convert_encoding('&#' . intval($u) . ';', 'UTF-8', 'HTML-ENTITIES');
                                     
		}
		//Hilfsfunktion zum speichern der logdaten
		function logToFile($strV) 
		{
			$datei = fopen("schachverlauf.txt", "a");
			fputs($datei, $strV);
			fclose($datei);									
		};

		$WEISS = "w";
		$SCHWARZ = "s";
		$png = ".png";
		$zugNum = (isset($_GET['zugnummer'])) ? $_GET['zugnummer']*1 : 1;
		$zugFarbe = $zugNum % 2 == 0 ? $SCHWARZ : $WEISS ;

		//TODO : Sessions
		//ist die Sessions white sperr für die Schwarzen Züge die input boxen
		// 
		$figurPfad='./schachimg/';
		$leer = 'leer';
	
	
	
	
	
	
	$_zug_erlaubt = false;
	
	// wurde schon ein Zug gemacht, oder ist es der erste Aufruf ?
	if(isset($_GET['Weitergabe'])){
		debug_to_console("Weitergabe isset"); 
	// bei einem Folgezug erfolgt Übernahme der Positionen und Auswerten des Formulars
		
		$brett = unserialize(($_GET["Weitergabe"])); 
		
	
		// Wenn die Übergabevariablen gesetzt wurden sind muss ja schon ein Zug vorher abgeschickt sein.
		if(isset($_GET['vonZ']) && isset($_GET['vonS']) && isset($_GET['nachZ']) && isset($_GET['nachS']))
		{
			debug_to_console("Alle Felder sind set");
						
						
						$vS = ord (strtoupper($_GET['vonS'])) -64; 
						$vZ = (($_GET['vonZ']-8)*-1)+1;

						$nZ = (($_GET['nachZ']-8)*-1)+1;
						$nS = ord (strtoupper($_GET['nachS']))-64;
						
						$_zug_erlaubt = isZugErlaubt($vZ, $vS, $nZ, $nS, $brett, $leer, $zugNum, false);
					
						//TODO Gucken Feierbaned
						if($_zug_erlaubt){
							debug_to_console("Zug erlaubt!!!!!!");
							
							$brett[$nZ][$nS]=$brett[$vZ][$vS];
							$brett[$vZ][$vS]=$leer;
							
							$isSchach = SchachPrufung($brett,$nZ,$nS,$zugNum,$leer,true);
								 
							$zugNum++;
						}
						 
						$Weitergabe = serialize($brett); 
					}												
		
	}else{
			debug_to_console("zeichne Brett");
			//Ein Array mit Dateinamen der Bilder
			$brett = array(
						array(''),
						array('','turm','pferd','laufer','dame','konig','laufer','pferd','turm'),
						array('','bauer','bauer','bauer','bauer','bauer','bauer','bauer','bauer'),
						array('','leer','leer','leer','leer','leer','leer','leer','leer'),
						array('','leer','leer','leer','leer','leer','leer','leer','leer'),
						array('','leer','leer','leer','leer','leer','leer','leer','leer'),
						array('','leer','leer','leer','leer','leer','leer','leer','leer'),
						array('','wbauer','wbauer','wbauer','wbauer','wbauer','wbauer','wbauer','wbauer'),
						array('','wturm','wpferd','wlaufer','wdame','wkonig','wlaufer','wpferd','wturm')
						
					); 
		
				  $Weitergabe= serialize($brett);
	}
	?>
	
		<body>
		<h1>Schachfigurenbrett</h1>
		<form name="Eingabe" action="index.php " method="get"> Spieler: <?php echo "$zugFarbe";?> Bitte geben Sie Ihren Zug ein <br>
			<div id="playerbox">
				Dein Spielername:<input type="text" name="Spielername">
									
			</div>
			<div>
				<p>Von Spalte
				<input type="text" id="vonS" size="1" maxlength="1" name="vonS">
				Von Zeile
				<input type="text" id="vonZ" size="1" maxlength="1" name="vonZ"></p>

				<p>Nach Spalte
				<input type="text" id="nachS" size="1" maxlength="1" name="nachS">
				Nach Zeile
				<input type="text" id="nachZ" size="1" maxlength="1" name="nachZ"></p>
			</div>
		
			<input id="zugnummer" type="text" name="zugnummer" value = "<?php echo $zugNum;?>" />
			<input type="hidden" name="isErlaubt" value="<?php echo !$_zug_erlaubt ? 'true' : 'false'; ?>">
			<input type="hidden" name="Weitergabe" value="<?php echo htmlspecialchars($Weitergabe, ENT_QUOTES, 'UTF-8'); ?>"/>
			<input type="submit" value="Zug ausführen"/>
			<input type="button" name="Reset" value="Reset" onclick="reloadPage();"/>
			
				</form>
				<?php 
				
echo("<table>");
					// Schachbrett zeichnen aus $brett
				    // echo __LINE__.' Schachbrett aus $brett darstellen>> ';var_dump($brett);
					for($j=1,$h=8;$j<=8;$j++,$h--){

						echo '<tr>';
						for($i=1;$i<=8;$i++){
							
							//c  ist ein array mit dem Coords zb. "A,2"
							$c = array( unichr(64+$i) , $h );
							//Wenn das Feld leer ist wird ein leer div gezeichnet mit der onclick methode
							$emptydiv = '<div id="'.$i.$c[1].'" class="empty" onclick="setFormFields('.$i.','.$c[1].',true);"></div>
											<span>'.$c[0].$c[1].'</span>';

							//Vorbereitung des ImgStrings
							$wayImg = '<img  id="'.$i.$c[1].'" src="'.$figurPfad.$brett[$j][$i].$png.'" 
											onclick="setFormFields('.$i.','.$c[1].',false); ondrag();" >
										<span>'.$c[0].$c[1].'</span>';

							//String wird zusammengesetzt				
							$fieldcontent = ($brett[$j][$i] == "leer") ? $emptydiv : $wayImg;
							
							echo'<td id="'. $c[1].$i.'" ondrop="drop(event)" ondragover="allowDrop(event)">'.$fieldcontent.'</td>';
						}
						echo'</tr>';
					}  
echo("</table>");
				?>	
			
				
			</table>
		</body>
				<script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
				<script src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script> 
				<script src="spiel.js"></script>
</html>		