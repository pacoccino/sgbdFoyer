<?php

class Liste extends Layout{
	public function bodyHTML() {
			
			$query = "select * from ACTEUR";
			$result= $this->core->dbInter->query($query);
			if(!($result))
			{
				echo "Erreur de requete : ".$this->dbInter->errorMsg();
			}
			else
			{
				while($res = $result->fetchArray(SQLITE3_ASSOC)){ 
					foreach($res as $field=>$value) {
						echo $field ." : ".$value." <br />";
					}
				} 
			}
	}
}
?>
