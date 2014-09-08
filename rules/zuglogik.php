<?php

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
		function isZugErlaubt($_vZ, $_vS, $_nZ, $_nS, $_brett, $_leer, $_zugFarbe, $_4Schach)
		{

				//ENUM
				$WEISS = "w";
				$SCHWARZ = "s";

				$br = "<br/>";
	
				$boo = false;
				
			//Wenn die Zugnummer gerade ist, ist weiß am Zug wenn es ungerade ist schwarz	
								
			//---------Quellfigur			
			$rawFigur = $_brett[$_vZ][$_vS];
			$figurFarbe = ($rawFigur[0] == $WEISS ? $WEISS : "");
			$figurName = ($figurFarbe == $WEISS ? substr($rawFigur, 1) : substr($rawFigur, 0));

	
			//------ Ziel Position
			$zielPosition = $_brett[$_nZ][$_nS];
			$zielPositionIsLerr = ($zielPosition == "leer" ? true : false);
	
			$feldFigurFarbe = (!$zielPositionIsLerr && $zielPosition[0] == $WEISS ) ? $WEISS : $SCHWARZ ;
		
			
			//Wenn die _zugFarbe ungleich der Figurfarbe? Quasi das der Spieler die richtige Farbe bewegt
			if($_zugFarbe != $figurFarbe)
			{
				
				//debug_to_console("Figurname: ".$figurFarbe. $figurName);
			
				switch($figurName){
					
					case ("bauer"):
					
					 	$isZugKorrekt = checkBauer($_vZ, $_vS, $_nZ, $_nS, $_brett, $_leer, $feldFigurFarbe, $figurFarbe);
						
						break;
					case("turm"):
						
					 	$isZugKorrekt = checkTurm($_vZ, $_vS, $_nZ, $_nS, $_brett, $_leer, $feldFigurFarbe, $figurFarbe);
		
						break;
					case("laufer"):
						
					 	$isZugKorrekt = checkLaufer($_vZ, $_vS, $_nZ, $_nS, $_brett, $_leer, $feldFigurFarbe, $figurFarbe);
						break;
					
					case("pferd"):
						
						$isZugKorrekt = checkPferd($_vZ, $_vS, $_nZ, $_nS, $_brett, $_leer, $feldFigurFarbe, $figurFarbe);
						break;
	
					case("konig"):
						$isZugKorrekt = checkKonig($_vZ, $_vS, $_nZ, $_nS, $_brett, $_leer, $feldFigurFarbe, $figurFarbe);
						break;
						
					 
					case("dame"):
									
						
						$isZugKorrekt = checkTurm($_vZ, $_vS, $_nZ, $_nS, $_brett, $_leer, $feldFigurFarbe, $figurFarbe) || checkLaufer($_vZ, $_vS, $_nZ, $_nS, $_brett, $_leer, $feldFigurFarbe, $figurFarbe) ? true : false;

						break;
					default:
						
						$isZugKorrekt = false;
						break;
				}

			}
			else{
				debug_to_console("Zug nicht erlaubt -- Farben gleich");
				$isZugKorrekt = false;
			}

			
			return $isZugKorrekt;
		}

		?>