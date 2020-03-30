<form action="index.php?route=addChild" method="post">
	<div class="flex">
		<div class="margin">
			<h2>L'enfant</h2>
			<p><label for="lastname">Nom :</label><input type="text" name="last_name" id="lastname" required></p>
			<p><label for="firstname">Prenom :</label><input type="text" name="first_name" id="firstname" required></p>
			<p><label for="birth_date">Date de naissance :</label><input type="date" name="birth_date" id="birth_date" required></p>
			<p><label for="gender">Garçon</label><input type="radio" name="gender" value="m" required></p>
			<p><label for="gender">Fille</label><input type="radio" name="gender" value="f" required></p>
			<p><label for="address">Adresse</label><textarea name="address" id="address" cols="40" rows="1"></textarea></p>
		</div>
		<div class="margin">
			<p><label for="allergies">Allergies</label><textarea name="allergies" id="allergies" cols="40" rows="4"></textarea></p>
			<p><label for="vaccines">Vaccins</label><textarea name="vaccines" id="vaccines" cols="40" rows="4"></textarea></p>
			<p><label for="other">Autres Informations</label><textarea name="other" id="other" cols="40" rows="4"></textarea></p>
		</div>
	</div>
	<div class="flex">
		<div class="margin">
			<h2>Père</h2>
			<p><label for="f_lastname">Nom :</label><input type="text" name="f_last_name" id="f_lastname"></p>
			<p><label for="f_firstname">Prenom :</label><input type="text" name="f_first_name" id="firstname"></p>
			<p><label for="f_phone">N° de téléphone</label><input type="text" name="f_phone" id="f_phone"></p>
			<p><label for="f_mail">Adresse mail</label><input type="email" name="f_mail" id="f_mail"></p>
		</div>
		<div class="margin">
			<h2>Mère</h2>
			<p><label for="m_name">Nom :</label><input type="text" name="m_last_name" id="m_lastname"></p>
			<p><label for="m_firstname">Prenom :</label><input type="text" name="m_first_name" id="firstname"></p>
			<p><label for="m_phone">N° de téléphone</label><input type="text" name="m_phone" id="m_phone"></p>
			<p><label for="m_mail">Adresse mail</label><input type="email" name="m_mail" id="m_mail"></p>
		</div>
	</div>
	<input type="submit" value="Enregistrer" name="submit">
</form>