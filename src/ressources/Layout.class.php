<?php
error_reporting(E_ALL);
abstract class Layout {
	
	protected $core;
	
	public function __construct($core) {
		$this->core=$core;
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
<html>
<header>
</header>
<body>
<h1>Bonjour </h1><br />

Projet SGBD Foyer <br />
<br />
<?php $this->core->pouet(); ?>
<hr />
<h2>Debug :</h2>
<?php $this->core->debugHTML(); ?>
<hr />
<h2>SQL :</h2>

<form method="post" action="index.php">
	<input type="hidden" name="sqlpost" value="true">
    <p>
        <label for="sqlreq">Requete :</label>
        <input type="text" name="sqlreq" id="sqlreq" placeholder="Ex : select * from TABLE;" size="30" />
    </p>
    <p>Resultat :</p>
    <p> <?php $this->core->sqlHTML(); ?> </p>
</form>
<hr />
<h2>Page :</h2>

<?php		
	}
	
	public function footerHTML() {

?>
</body>
</html>

<?php		
	}
	
}

?>
