<?php

function checkBauer($_vZ, $_vS, $_nZ, $_nS, $_brett, $_leer, $_feldFigurFarbe, $_figurFarbe){

	debug_to_console("checkBauer");
	$_isZugKorrekt = false;
	if ( (($_vZ*8+$_vS)-($_nZ*8+$_nS)) % 8 == 0 ){       // 8,16,......{  // geht nicht schräg
		debug_to_console("1. if");
							if(($_vZ == 1) || ($_vZ == 6) ){// wenn erster Zug   wären 8 oder 16 erlaubt{
								$_isZugKorrekt = (abs($_vZ-$_nZ) < 3 ? true : false);
								debug_to_console("2. if");
							}
							else{// sonst nur 8		
							
								$_isZugKorrekt = (abs($_vZ-$_nZ) < 2 ? true : false);
							}
						}
						else {
							// will er schlagen ?
							if ( abs(($_vZ*8+$_vS)-($_nZ*8+$_nS)) == 7 || abs(($_vZ*8+$_vS)-($_nZ*8+$_nS)) == 9){
								debug_to_console("else Funktion");
									
								$_isZugKorrekt = (	$_feldFigurFarbe != $_figurFarbe && 
													$_brett[$_nZ][$_nS] != $_leer 
													? true : false);
								
								
							}
									
						}
						debug_to_console("Ende Funktion");
	return $_isZugKorrekt;
}
	
?>