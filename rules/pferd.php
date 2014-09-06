<?php
function checkPferd($_vZ, $_vS, $_nZ, $_nS, $_brett, $_leer, $_feldFigurFarbe, $_figurFarbe)
{
	$isZugKorrekt = false;
						debug_to_console("Pferdzug-Prüfung:");
								
  	$isZugKorrekt = (	(abs($_vZ-$_nZ) == 1 && abs($_vS-$_nS) == 2) ||
  						(abs($_vZ-$_nZ) == 2 && abs($_vS-$_nS) == 1)
  				
  					)	 ? true : false;
							

	return $isZugKorrekt;	
}
			

?>