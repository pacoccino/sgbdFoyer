<?php

// Classe de base contenant tout le html autour de corps de page
abstract class Layout {
	
	protected $core;
	protected $AJAX = false;
	
	public function __construct($core) {
		$this->core=$core;
	}	
	
	public function showHTML()
	{
		return !($this->AJAX);
	}
	
	public function toHTML() {
		$this->headerHTML();
		$this->bodyHTML();
		$this->footerHTML();
	}
	
	public function bodyHTML() {
		echo "should not be initialized <br />";
		$this->core->pageHTML();
	}
	
	public function headerHTML() {

?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8" />

		<!-- Always force latest IE rendering engine (even in intranet) & Chrome Frame
		Remove this if you use the .htaccess -->
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

		<title>HTML</title>
		<meta name="description" content="" />
		<meta name="author" content="Pacien Boisson" />

		<meta name="viewport" content="width=device-width; initial-scale=1.0" />

		<!-- Replace favicon.ico & apple-touch-icon.png in the root of your domain and delete these references -->
		<link rel="shortcut icon" href="/favicon.ico" />
		<link rel="apple-touch-icon" href="/apple-touch-icon.png" />
		
		<link rel="stylesheet" href="ressources/style.css" />
		<link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
		<script type="text/javascript" src="ressources/script.js"></script>
	</head>

	<body>
		<div id="menu">
			<nav>
				<ul>
					<li>
						<a href="index.php">Accueil</a>
					</li>
					<li>
						<a href="?action=liste">Liste d'élèves</a>
					</li>
					<li>
						<a href="#">Le bureau</a>
					</li>
					<li>
						<a href="#">Evenements</a>
					</li>
					<li>
						<a href="#">Les livres</a>
					</li>
					<li>
						<a href="#">Les jeux</a>
					</li>
				</ul>
			</nav>
		</div>
	<div id="right">
		<div id="body">    
<?php
			}

			public function footerHTML() {
		?>
</div>
		<div id="sql_req">
			<h1>Requete SQL :</h1>
				<form method="post" action="index.php">
				<input type="hidden" name="sqlpost" value="true">
				<p>
					<label for="sqlreq">Requete :</label>
					<input type="text" name="sqlreq" id="sqlreq" placeholder="Ex : select * from TABLE;" size="30" />
				</p>
				<p>Resultat : </p>
				<p> <?php $this -> core -> sqlHTML(); ?></p>
				</form>
		</div>
	
		<div id="footer">
			<footer>
				<p>
					&copy; Copyright  by Pacien Boisson
				</p>
			</footer>
		</div>
		<div id="debug">
		<b>Debug :</b><br />
		<?php $this -> core -> debugHTML(); ?>
		</div>
	</div>
	</body>
</html>


<?php
	}

	}
?>
