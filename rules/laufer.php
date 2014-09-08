<?php
/*
Funktioniert, solange nichts im Weg steht
 */
function checkLaufer($_vZ, $_vS, $_nZ, $_nS, $_brett, $_leer, $_feldFigurFarbe, $_figurFarbe){
	
	$isZugKorrekt = false;
	
	$abstand = 	($_vZ*8+$_vS)-($_nZ*8+$_nS);
	$richtungH = ($_vZ*8+$_vS) < ($_nZ*8+$_nS) ? 1 : -1;
	$richtungV = $_vS > $_nS ? -1 : 1;
	$isBlocked = false;
	$pos1 = ($_vZ*7+$_vS); echo "$pos1";
	$pos2 = ($_nZ*7+$_nS); echo "$pos2";
	$isRichtunOK = false;


	if ($abstand%7==0) {
		$isRichtunOK = true;

					
					
		for ($s=$_vS+$richtungV,$z=$_vZ+$richtungH; $z*7+$s!=$_nZ*7+$_nS; $s+=$richtungV,$z+=$richtungH)
		{
				/*debug_to_console("Von:".($z*7+$s)." Nach:".($_nZ*7+$_nS));
				debug_to_console("Wir sind im Feld: ".$z.", ".$s);
				debug_to_console($_brett[$z][$s]);
*/
				if ($_brett[$z][$s] != "leer") {
					//debug_to_console("Das ist im Weg:".$_brett[$z][$s]);
					$isBlocked = true;
					break;
				}

		}
					
			
				 
			} elseif($abstand%9==0) {
				$isRichtunOK = true;

		for ($s=$_vS+$richtungV,$z=$_vZ+$richtungH; $z*7+$s!=$_nZ*7+$_nS; $s+=$richtungV,$z+=$richtungH)
		{
/*				debug_to_console("Von:".($z*7+$s)." Nach:".($_nZ*7+$_nS));
				debug_to_console("Wir sind im Feld: ".$z." ".$s);
				debug_to_console($_brett[$z][$s]);
*/
				if ($_brett[$z][$s] != "leer") {
					//debug_to_console("Das ist im Weg:".$_brett[$z][$s]);
					$isBlocked = true;
					break;
				}

		}

			}
			$isZugKorrekt = !$isBlocked && $isRichtunOK ? true : false;

	return $isZugKorrekt;
}

?>