<?php
/*
Funktioniert, solange nichts im Weg steht
 */
function checkLaufer($_vZ, $_vS, $_nZ, $_nS, $_brett, $_leer, $_feldFigurFarbe, $_figurFarbe){
	
	$isZugKorrekt = false;
	
	$abstand = 	($_vZ*8+$_vS)-($_nZ*8+$_nS);
	$richtung = ($_vZ*8+$_vS) < ($_nZ*8+$_nS) ? 1 : -1;
	$isBlocked = true;
	$pos1 = ($_vZ*7+$_vS); echo "$pos1";
	$pos2 = ($_nZ*7+$_nS); echo "$pos2";
	$isRichtunOK = false;


			if ($abstand%7==0) {
				$isRichtunOK = true;
				for ($i=$pos1+($richtung*7); $i <= $pos2 || $i >= $pos2 ; $i=$i+($richtung*7))
				{

					debug_to_console("floor:".floor($i/7)." & Modulo: ". $i%8);
					debug_to_console($_brett[floor($i/7)][$i%7]);
					if ($_brett[floor($i/7)][$i%7] != $_leer) {
						$isBlocked = true;
						debug_to_console("Da ist ein ".$_brett[floor($i/7)][$i%7]." im Weg");
						break;
					}
					
				}
				 
			} elseif($abstand%9==0) {
				$isRichtunOK = true;

			for ($i=$pos1+($richtung*9); $i < $pos2 || $i > $pos2 ; $i=$i+($richtung*9))
				{
					debug_to_console("floor:".floor($i/7)." & Modulo: ". $i%7);
					debug_to_console($_brett[floor($i/7)][$i%7]);
					if ($_brett[floor($i/7)][$i%7] != $_leer) {
						$isBlocked = true;
						debug_to_console("Da ist ein ".$_brett[floor($i/7)][$i%7]." im Weg");
						break;
					}
				}

			}
			$isZugKorrekt = !$isBlocked && $isRichtunOK ? true : false;

	return $isZugKorrekt;
}

?>