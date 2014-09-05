<?php
function checkPferd(){
	$possDiff = array(6,10,15,17,-6,-10,-15,-17);

						//Für jeden Mögliche Differenz ein durch gan
						foreach ($possDiff as $Diff) {
												
							$isZugKorrekt = ($_vZ * $_vS)-($_nS*$_nZ) == $Diff ? true : false;
							if ($isZugKorrekt) {
								break;
							};
							
						}
}
?>