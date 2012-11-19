<?php

class Liste extends Layout{
	public function bodyHTML() {
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
			}
	}
}
?>
