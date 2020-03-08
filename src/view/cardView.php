<?php $title = "Fiche de l\'enfant"; ?>
<?php
$lastName = strtoupper($child->getLastName());
$firstName = ucfirst($child->getFirstName());
$birthDate = $child->getBirthDate();
$diff = $child->getBirthDate()->diff(new DateTime());
?>

<h2 align='center'><?= $lastName ?> <?= $firstName ?></h2>
<p>
	né le <?= $birthDate->format('d/m/Y') ?><br>
	<?= $diff->y ?> ans <?= $diff->m ?> mois <?= $diff->d ?> jours
</p>

<section>
	<h2 align='center'>Informations Administratives</h2>

	<p>Adresse : </p>

	<p>Pere : </p>
	<p>Mere : </p>

	<h3>Personnes autorisees a recuperer l'enfant</h3>

	<p>Nom : </p>
	<p>Prenom : </p>
	<p>N° CIN : </p>

	<h3>Medical</h3>

	<p>Allergies : </p>
</section>