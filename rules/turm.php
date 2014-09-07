<?php

	function checkTurm($_vZ, $_vS, $_nZ, $_nS, $_brett, $_leer, $feldFigurFarbe, $figurFarbe){
		//Zeile Von und _Nach sind gleich aber Spalte verschieden ansonsten ungedreht
		debug_to_console('checkD1');
		
						if ($_vZ == $_nZ && $_vS != $_nS) {
							
							//Für jedes Feld bis zum Ziel
							for ($s=$_vS; $s<$_nS; $s++){
								//Wenn im aktuellen Feld was drin ist, dann wird die Schleife beendet
								$isZugKorrekt = ($_brett[$_nZ][$s] != $_leer) ? false :true;

							}

						}elseif ($_vS == $_nS && $_vZ != $_nZ) {
							
							for ($z=$_vZ; $z<$_nZ; $z++){
								$isZugKorrekt = ($_brett[$z][$_nS] != $_leer) ? false : true ;
							}
						}
	}

?>