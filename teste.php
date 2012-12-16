<form method=post>
<input type="checkbox" name="jury[]" value="11"/>
<input type="checkbox" name="jury[]" value="12"/>
<input type="checkbox" name="jury[]" value="14"/>
<input type="checkbox" name="jury[]" value="15"/>
<input type="checkbox" name="jury[]" value="16"/>
<input type="checkbox" name="jury[]" value="23"/>
<input type="checkbox" name="jury[]" value="26"/>
<input type="checkbox" name="jury[]" value="31"/>
<button>go</button>
 </form>
<!-- le code php 
 
Il ne reste plus qu'a les parcourir avec un foreach
 
-->
 
<?php
 
if(isset($_POST['jury'])){ //sera vrai si au moins un moins un checkbox a Ã©tÃ© cochÃ©
 
	foreach($_POST['jury'] as $chkbx){
 
		//ici Ã  chaque passage $chkbx contiendra la valeur de l'attribut value d'une des cases Ã  cocher
		echo $chkbx; //ex. : 12 16 23 31 ...							
 
	}
}
?>