<form action="index.php?route=addChild" method="post">
	<p><label for="name">Nom :</label><input type="text" name="last_name" id="name"></p>	
	<p><label for="firstname">Prenom :</label><input type="text" name="first_name" id="firstname"></p>	
	<p><label for="birth_date">Date de naissance :</label><input type="date" name="birth_date" id="birth_date"></p>
	<p><label for="gender">Garçon</label><input type="radio" name="gender" value="m"></p>
	<p><label for="gender">Fille</label><input type="radio" name="gender" value="f"></p>
	<input type="submit" value="Enregistrer" name="submit">
</form>