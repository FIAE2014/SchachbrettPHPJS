<?php
function checkPferd($_vZ, $_vS, $_nZ, $_nS, $_brett, $_leer, $_feldFigurFarbe, $_figurFarbe){
	$isZugKorrekt = false;
	$possDiff = array(6,11,15,17,-6,-11,-15,-17);

						//Für jeden Mögliche Differenz ein durch gan
						foreach ($possDiff as $Diff) {
							debug_to_console(($_vZ * $_vS)-($_nS*$_nZ));
								

							$isZugKorrekt = ($_vZ * $_vS)-($_nS*$_nZ) == $Diff ? true : false;
							if ($isZugKorrekt) {
								debug_to_console("Pferdzug möglich");
								break;
							};
							
						}
						return $isZugKorrekt;
}
?>