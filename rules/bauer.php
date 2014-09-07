<?php

function checkBauer($_vZ, $_vS, $_nZ, $_nS, $_brett, $_leer, $_feldFigurFarbe, $_figurFarbe){

	$_isZugKorrekt = false;
	
	if ( (($_vZ*8+$_vS)-($_nZ*8+$_nS)) % 8 == 0 ){       // 8,16,......{  // geht nicht schräg
							if(($_vZ == 2) || ($_vZ == 7) ){// wenn erster Zug   wären 8 oder 16 erlaubt{
								$_isZugKorrekt = (abs($_vZ-$_nZ) < 3 ? true : false);
							}
							else{// sonst nur 8		
							
								$_isZugKorrekt = (abs($_vZ-$_nZ) < 2 ? true : false);
							}
						}
						else {
							// 	(Zeile * 8 + Spalte)-(nachZeile*8+nachSpalte) 
							if ( abs(($_vZ*8+$_vS)-($_nZ*8+$_nS)) == 7 || abs(($_vZ*8+$_vS)-($_nZ*8+$_nS)) == 9){
									
								$_isZugKorrekt = (	$_feldFigurFarbe != $_figurFarbe && 
													$_brett[$_nZ][$_nS] != $_leer 
													? true : false);
								
								
							}
									
						}
	return $_isZugKorrekt;
}
	
?>