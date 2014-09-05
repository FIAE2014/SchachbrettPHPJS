<?php

function checkLaufer(){
	

						$richtungVertikal = ($_vZ*$_vS>$_nZ*$_nS) ? true : false;
						

						if (($_vZ * $_vS)-($_nS*$_nZ) % 9 == 0 || ($_vZ * $_vS)-($_nS*$_nZ) % 7 == 0) {
							
							$richtungHorizontal = ($_vZ * $_vS)-($_nS*$_nZ) % 9 == 0 ? 9 : 7;

							if ($richtungVertikal) {
								for ($z = $_vZ , $s = $_vS; $z*$s < $_nS*$_nZ ; ($richtungHorizontal==7?$s--:$s++),$z++) { 
									$isZugKorrekt = $_brett[$z][$s] != $leer ? false : true;
								}
							}else{
								for ($z = $_vZ , $s = $_vS; $z*$s < $_nS*$_nZ ; ($richtungHorizontal==7?$s--:$s++),$z--) {
									$isZugKorrekt = $_brett[$z][$s] != $leer ? false : true;
								}
							}
							
							
						}
}

?>