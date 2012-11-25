<?php

class Liste extends Layout{
	public function bodyHTML() {
		?>
		<h1>Liste des acteurs :</h1>
		Page de test de bdd temporaire. <br/><br/>
		<?php
			$query = "select * from ACTEUR";
			$result= $this->core->dbInter->query($query);
			if(!($result))
			{
				echo "Erreur de requete : ".$this->core->dbInter->errorMsg();
			}
			else
			{
				while($res = $this->core->dbInter->fetch($result)){ 
					foreach($res as $field=>$value) {
						echo $field ." : ".$value." <br />";
					}
				} 
				if($this->core->dbInter->testEmpty() == true)
					$st = "true";
				else
					$st = "false";
				echo "emp:".$st;
			}
	}
}
?>
