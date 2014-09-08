<?php

function checkKonig($_vZ, $_vS, $_nZ, $_nS, $_brett, $_leer, $_feldFigurFarbe, $_figurFarbe){

	$_isZugKorrekt = false;

	$_isZugKorrekt = 	abs($_vS-$_nS) == 1 && abs($_vZ-$_nZ) == 0||
						abs($_vZ-$_nZ) == 1 && abs($_vS-$_nS) == 0|| 
						abs(($_vZ*8+$_vS)-($_nZ*8+$_nS)) == 7 || 
						abs(($_vZ*8+$_vS)-($_nZ*8+$_nS)) == 9
				? true : false;
	 
	
						
	return $_isZugKorrekt;
}
	
?>