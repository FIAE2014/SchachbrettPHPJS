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
				if ((zaehler % 2 != 0 && isWhite) || (zaehler % 2 == 0 && !isWhite) && !leer ) {
					
					$("#vonS").val(String.fromCharCode(spalte+64));
					$("#vonZ").val(zeile);

				}else{

					$("#nachS").val(String.fromCharCode(spalte+64));
					$("#nachZ").val(zeile);

				};
				

			}

			function allowDrop(ev) {
        	ev.preventDefault();
        	console.log(ev.target.id);
        	var elementid = ev.target.id;

         	var spalte = elementid.charAt(1);
         	var zeile = elementid.charAt(0);
					$("#nachS").val(String.fromCharCode(spalte+64));
					$("#nachZ").val(zeile);
    }

    //Wenn angefangen wird ein Objekt aufzunehmen wird die Funktion ausgeführt
    function drag(ev) {
        //console.log("drag startet of "+ev.target.id);
        var elementid = ev.target.id;
        ev.dataTransfer.setData("Text", elementid);

         spalte = elementid.charAt(0);
         zeile = elementid.charAt(1);
          console.log(spalte); console.log(zeile);
					$("#vonS").val(String.fromCharCode(spalte+64));
					$("#vonZ").val(zeile);
        
        }
        
   //Wenn ein Objekt nieder gelegt wird    
    function drop(ev) {
        ev.preventDefault();
       
   
    }