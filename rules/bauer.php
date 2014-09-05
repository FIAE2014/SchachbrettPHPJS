<?php

function checkBauer(){
	if ( (($_vZ*8+$_vS)-($_nZ*8+$_nS)) % 8 == 0 ){       // 8,16,......{  // geht nicht schräg
							if(($_vZ == 1) || ($_vZ == 6) ){// wenn erster Zug   wären 8 oder 16 erlaubt{
								$isZugKorrekt = (abs($_vZ-$_nZ) < 3 ? true : false);
							}
							else{// sonst nur 8		
							
								$isZugKorrekt = (abs($_vZ-$_nZ) < 2 ? true : false);
							}
						}
						else {
							// will er schlagen ?
							if ( abs(($_vZ*8+$_vS)-($_nZ*8+$_nS)) == 7 || abs(($_vZ*8+$_vS)-($_nZ*8+$_nS)) == 9){
								
									
									$isZugKorrekt = ($feldFigurFarbe != $figurFarbe && $_brett[$_nZ][$_nS] != $_leer ? true : false);
									echo $feldFigurFarbe;
									echo $figurFarbe;
								
							}
							else {
								 return false;
							}		
						}
}

?>