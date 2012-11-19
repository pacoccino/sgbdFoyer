<html>
<header>
</header>
<body>
Bonjour <br />

Projet SGBD Foyer <br />
<br />
<?php $core->pouet(); ?>
<hr />
<h2>Debug :</h2>
<?php $core->debugHTML(); ?>
<hr />
<h2>Page :</h2>
<?php $core->pageHTML(); ?>
<hr />
<h2>SQL :</h2>

<form method="post" action="index.php">
	<input type="hidden" name="sqlpost" value="true">
    <p>
        <label for="sqlreq">Requete :</label>
        <input type="text" name="sqlreq" id="sqlreq" placeholder="Ex : select * from TABLE;" size="30" />
    </p>
    <p>
    Resultat : <?php $core->sqlHTML(); ?></p>
</form>
</body>
</html>
