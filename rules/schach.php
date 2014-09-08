<?php
	 

	function SchachPrufung($_brett,$_vZ,$_vS,$_zugNum,$_leer,$_4Schach){
		$WEISS = "w";
		$zugFarbe = $_zugNum % 2 == 0 ? $WEISS : "" ;
		$meinFigur = $_brett[$_vZ][$_vS];
		debug_to_console("Prüfung auf Schach mit ".$meinFigur);

		for ($z=1; $z < 8 ; $z++) 
		{ 
			for ($s=1; $s<8 ; $s++) 
			{ 

				debug_to_console($z.$s);  
				if ($_brett[$z][$s]==$zugFarbe."konig") 
				{
						$konigS = $s;
						$konigZ = $z;
						debug_to_console("König gefunden auf Zeile:".$z." Spalte:".$s);

						$isSchach = isZugErlaubt($_vZ,$_vS,$konigZ,$konigS,$_brett,$_zugNum,$_leer,$_4Schach);	 
						if ($isSchach) 
						{
							debug_to_console("Der Gegnerkönig steht im Schach");
							$isMatt = SchachMattPrufung($konigZ,$konigS,$_brett,$_zugNum);
							if (!$isMatt) {
								echo "<h1>SCHAMCHTTTTTTTTT</h1>";
							}
							return true;
						}
						break;
					 	
				}
			}
		}

	}

	function SchachMattPrufung($_konigZ,$_konigS,$_brett,$_zugNum)
	{
		debug_to_console("--------------------SchachMattPrufung------");
		// Prüfung jedes nicht weiter als 1 entfernte Feld ob es leer ist && Prufe ob alle Gegner Figuren da hin kommen
		$zugFarbe = $_zugNum % 2 == 0 ? "w" : "" ;
		$konigFarbe = getFigurFarbe($_brett,$_konigZ,$_konigS);
		$MoglicherAusweichPunkt = true;

		for ($zeile=1; $zeile<=8 ; $zeile++) 
		{ 
			for ($s=1; $s<=8 ; $s++) 
			{ 
					if ($_brett[$zeile][$s] == "leer" && isZugErlaubt($_konigZ,$_konigS,$zeile,$s,$_brett,"leer",$_zugNum,false) ) 
					{
						debug_to_console("MoglicherAusweichPunkt bei".$zeile.$s." postiv");
					 
							
							for ($z2=1; $z2 <= 8; $z2++) 
							{ 
								for ($s2=1; $s2 <= 8; $s2++) 
								{ 
									
									if ($_brett[$z2][$s2] != "leer" && $konigFarbe != getFigurFarbe($_brett,$z2,$s2) ) 
									{
										//debug_to_console($_brett[$z2][$s2]." auf $z2 $s2 wird auf mögichen Zug gegen König probiert");
										$zuger = isZugErlaubt($z2, $s2, $zeile, $s, $_brett, "leer", $zugFarbe, "false");
										if ($zuger) 
										{
											debug_to_console($_brett[$z2][$s2]." kann den König schlagen");
											$MoglicherAusweichPunkt = false;
										}

									 

									
								}
							}

						

					}


				}

			}
		
			
		}				
			return $MoglicherAusweichPunkt;
	}

	function getFigurFarbe($_brett,$_z,$_s){
		$WEISS = "w";
		$rawFigur = $_brett[$_z][$_s];
		switch ($rawFigur[0]) {
			case 'w':
				return "w";
				break;
			
			//case 'l':
			//	return "leer";
			//	break;

			default:
				return "";
				break;

		}
	}
?>
