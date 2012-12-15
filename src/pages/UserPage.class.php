<?php

class Userpage extends Layout{
	private $status;
	
	public function __construct()
	{
		$this->pageTitle = "Connexion";
		if(isset($_POST['login']))
		{
			$sql = "SELECT id_eleve FROM ELEVE WHERE login='".$_POST['login']."'";
			Database::query($sql);
			if(Database::$lastResult->num_rows == 1)
			{
				$res=Database::fetch();
				$_SESSION['loggedin']=$res['id_eleve'];
				Core::$eleve_co = new Eleve();
				Core::$eleve_co->getFromDatabase($_SESSION['loggedin']);
				$this->status="<font color='green'>Vous êtes bien connecté.</font>";
			}
			else
			{
				$this->status= "<font color='red'>Login inconnu</font>";
			}
		}
		elseif($_GET['action']=="logout")
		{
			unset($_SESSION['loggedin']);
		}
	}
	// cette fonction est ce que va afficher la page web
	public function bodyHTML() {
?>
<script>
	$(function()
	{
		$("button").button();
	});
</script>
<h1>Page utilisateur</h1>
<?php
echo $this->status;
if($_GET['action']=="login" && !isset($_SESSION['loggedin']))
{
	?>
	<form action="index.php?action=login" method=post>
		<label for="login">Entrez votre login:</label>
		<input type="text" name="login" id="login" class="ui-widget-content ui-corner-all" />
		<button>Connexion</button>
	</form>
	<?php
}
elseif($_GET['action']=="logout")
{
	echo "Vous avez bien été déconnecté.";
}
?>
<?php
	}
}
?>
