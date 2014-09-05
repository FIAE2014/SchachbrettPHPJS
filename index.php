<!DOCTYPE HTML>
<html>
<head>
	<meta charset="utf-8">
	<title>Schachfigurenbrett für Anfänger</title>
	<link rel="stylesheet" href="style.css" type="text/css" >
</head>
	
	
	<?php
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

		$WEISS = "w";
		$SCHWARZ = "s";
		$png = ".png";
		$zugNo = (isset($_GET['zugnummer'])) ? $_GET['zugnummer']*1+1 : 1;

		$zugFarbe = $zugNo % 2 == 0 ? $SCHWARZ : $WEISS ;

		//Sessions
		//ist die Sessions white sperr für die Schwarzen Züge die input boxen
		$figurPfad='./schachimg/';
		$leer = 'leer';
	
		/**
		 * [isZugErlaubt checkt ob der Zug erlaubt ist]
		 * @param  [int] $_vZ - VonZug
		 * @param  [int] $_vS - VonSpalte
		 * @param  [int] $_nZ - nachZeile
		 * @param  [int] $_nS - nachSpalte
		 * @param  [array] $_brett
		 * @param  [string] $_leer
		 * @return [boolean]
		 */
		function isZugErlaubt($_vZ, $_vS, $_nZ, $_nS, $_brett, $_leer)
		{
				debug_to_console("Fuction isZugerLaubt");
				debug_to_console("isZugErlaubt-paras:".$_vZ.",".$_vS.",".$_nZ.",".$_nS.",".$_leer);

				//ENUM
				$WEISS = "w";
				$SCHWARZ = "s";

				$br = "<br/>";
	
				$boo = false;
				
			//Wenn die Zugnummer gerade ist, ist weiß am Zug wenn es ungerade ist schwarz	
			$zugFarbe = ($_GET['zugnummer'] % 2 == 0) ? $SCHWARZ : $WEISS ;
			
								
			//---------Quellfigur
			//Holt den String der Figur aus dem Brett Array an der Position vZvS
			//$quellfigur = explode($WEISS, $_brett[$_vZ][$_vS]);
			//$isWhiteQ = count($quellfigur);
			
			//newWhite PROTO chatAt[0]??
			
			$rawFigur = $_brett[$_vZ][$_vS];
			$figurFarbe = ($rawFigur == $WEISS ? $WEISS : $SCHWARZ);
			$figurName = ($figurFarbe == $WEISS ? substr($rawFigur, 1) : substr($rawFigur, 0));

			//$figurFarbe = ($isWhiteQ ? $WEISS : $SCHWARZ);
			//$explodeHelp = explode(".", $_brett[$_vZ][$_vS]);
			//$figurName 	= ($isWhiteQ ? substr(string, start) : $explodeHelp[0]);
			debug_to_console ("Figur war:".$figurFarbe.$figurName.$br);
	
		
	
			//------ Ziel Position
			$zielPosition = explode($WEISS, $_brett[$_nZ][$_nS]);
			$isZielWhite = count($zielPosition);
	
			$feldFigurFarbe = ($isZielWhite) ? $WEISS : $SCHWARZ ;
			debug_to_console ("Gegner Figur ist ".$feldFigurFarbe." <br>");
		
				
			
			
			//Wenn die Zugfarbe ungleich der Figurfarbe? Quasi das der Spieler die richtige Farbe bewegt
			if($zugFarbe != $figurFarbe)
			{
				
				debug_to_console("Figurname: ". $figurName);
				switch($figurName){
				 
					case ("bauer"):
						debug_to_console("bauer chosen");
					 	include './rules/'.$figurName.'.php';
					 	$isZugKorrekt = checkBauer($_vZ, $_vS, $_nZ, $_nS, $_brett, $_leer, $feldFigurFarbe, $figurFarbe);
						
						break;
					case("turm"):
						
					 	include './rules/'.$figurName.'.php';
					 	$isZugKorrekt = checkTurm($_vZ, $_vS, $_nZ, $_nS, $_brett, $_leer, $feldFigurFarbe, $figurFarbe);
		
						break;
					case("laufer"):
						
						include './rules/'.$figurName.'.php';
					 	$isZugKorrekt = checkLaufer($_vZ, $_vS, $_nZ, $_nS, $_brett, $_leer, $feldFigurFarbe, $figurFarbe);
						break;
					
					case("pferd"):
						
						include './rules/'.$figurName.'.php';
						$isZugKorrekt = checkPferd($_vZ, $_vS, $_nZ, $_nS, $_brett, $_leer, $feldFigurFarbe, $figurFarbe);
						break;
	
					case("koenig"):
						
						
						break;
					case("dame"):
						
						
						include './rules/turm.php';
						include './rules/laufer.php';
						$isZugKorrekt = checkTurm || checkLaufer ? true : false;

						break;
					default:
						
						$isZugKorrekt = false;
						break;
				}

			}
			else{
				debug_to_console("Zug nicht erlaubt -- Farben gleich");
				$isZugKorrekt = false;
				echo "Falscher Spieler <br>";
			}

			
			return $isZugKorrekt;
		}
	
	//Hilfsfunktion zum speichern der logdaten
	function logToFile($strV) 
	{
		$datei = fopen("schachverlauf.txt", "a");
		fputs($datei, $strV);
		fclose($datei);									
	};
	
	
	  
	
	// wurde schon ein Zug gemacht, oder ist es der erste Aufruf ?
	if(isset($_GET['Weitergabe'])){
		debug_to_console("Weitergabe isset"); 
	// bei einem Folgezug erfolgt Übernahme der Positionen und Auswerten des Formulars
		
		$brett = unserialize(($_GET["Weitergabe"])); 
		
	
		// Wenn die Übergabevariablen gesetzt wurden sind muss ja schon ein Zug vorher abgeschickt sein.
		if(isset($_GET['vonZ']) && isset($_GET['vonS']) && isset($_GET['nachZ']) && isset($_GET['nachS']))
		{
			debug_to_console("Alle Felder sind set");
			
						$vZ = $_GET['vonZ'];
						$vS = ord (strtoupper($_GET['vonS'])) -65+1; 
						$nZ = $_GET['nachZ'];
						$nS = ord (strtoupper($_GET['nachS']))-65+1;
						
						$_zug_erlaubt = isZugErlaubt($vZ, $vS, $nZ, $nS, $brett, $leer);
					
					
						if($_zug_erlaubt){

							debug_to_console("Zug erlaubt!!!!!!");
							$brett[$nZ][$nS]=$brett[$vZ][$vS];
							$brett[$vZ][$vS]=$leer;
							
								//logToFile($_GET["zugnummer"].":".$figurFarbe.$figurName."Von ".$_GET['vonS'].$vZ." nach ".$_GET['nachS'].$nZ."\n");
							
						}
						 
						$Weitergabe = serialize($brett); 
					}												
		
	}else{
			debug_to_console("zeichne Brett");
			$zugFarbe = $WEISS;
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
						array('','wturm','wpferd','wlaufer','wkonig','wdame','wlaufer','wpferd','wturm')
						
					); 
				  $Weitergabe= serialize($brett);
	}
	?>
	
		<body>
		<h1>Schachfigurenbrett</h1>
		<form name="Eingabe" action="index.php " method="get"> Spieler: <?php echo "$zugFarbe";?> Bitte geben Sie Ihren Zug ein <br>
			
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
		
			<input id="zugnummer" type="hidden" name="zugnummer" value = "<?php echo $zugNo;?>">
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
							$wayImg = '<img id="'.$i.$c[1].'" src="'.$figurPfad.$brett[$j][$i].$png.'" 
											onclick="setFormFields('.$i.','.$c[1].',false);" >
										<span>'.$c[0].$c[1].'</span>';

							//String wird zusammengesetzt				
							$fieldcontent = ($brett[$j][$i] == "leer") ? $emptydiv : $wayImg;
							
							echo'<td>'.$fieldcontent.'</td>';
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