	function reloadPage(){
				window.location.href = "index.php";
			}
	
	/**
	 * [setFormFields description]
	 * @param {[int]} spalte [description]
	 * @param {[int]} zeile  [description]
	 * @param {[boolean]} leer   [description]
	 */
	function setFormFields(spalte,zeile,leer){
				console.log("para:"+spalte+zeile+leer);
				figur = (!leer) ? ($("#"+spalte+zeile).attr('src')).slice(12,$("#"+spalte+zeile).attr('src').length) : "leer";
			
				isWhite = (figur.charAt(0) == "w" ? true : false);
				console.log(figur);

				var zaehler  = $("#zugnummer").val();
				
				//Wenn die Zugummer gerade und figur weiß is ODER zugnummer ungerade und schwarz
				if ((zaehler % 2 != 0 && isWhite) || (zaehler % 2 == 0 && !isWhite) && !Leer ) {
					
					$("#vonS").val(String.fromCharCode(spalte+64));
					$("#vonZ").val(zeile);

				}else{

					$("#nachS").val(String.fromCharCode(spalte+64));
					$("#nachZ").val(zeile);

				};
				

			}