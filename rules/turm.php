<?php

	function checkTurm(){
		//Zeile Von und _Nach sind gleich aber Spalte verschieden ansonsten ungedreht
						if ($_vZ == $_nZ && $_vS != $_nS) {
							
							//Für jedes Feld bis zum Ziel
							for ($s=$_vS; $s<$_nS; $s++){
								//Wenn im aktuellen Feld was drin ist, dann wird die Schleife beendet
								$isZugKorrekt = ($_brett[$_nZ][$s] != $_leer) ? false :true;

							}

						}elseif ($_vS == $_nS && $_vZ != $_nZ) {
							
							for ($z=$_vZ; $z<$_nZ; $z++){
								$isZugKorrekt = ($_brett[$_z][$_nS] != $_leer) ? false : true ;
							}
						}
	}

?>