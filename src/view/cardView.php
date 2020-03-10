<?php $title = "Fiche de l\'enfant"; ?>
<?php
$lastName = $child->getLastName();
$firstName = $child->getFirstName();
$birthDate = $child->getBirthDate();
$address = $child->getAddress() ?? '';
$diff = $child->getBirthDate()->diff(new DateTime());
$father = $child->getFather();
$mother = $child->getMother();
?>

<h2 align='center'><?= $lastName ?> <?= $firstName ?></h2>
<p>
	le <?= $birthDate->format('d/m/Y') ?><br>
	<?= $diff->y ?> ans <?= $diff->m ?> mois <?= $diff->d ?> jours
</p>

<section class="info">
	<h2 align='center'>Informations Administratives</h2>

	<table class="parent">
		<tr>
			<th></th>
			<th>NOM</th>
			<th>Prenom</th>
			<th>Telephone</th>
			<th>Mail</th>
		</tr>
		<tr>
			<td><?= isset($father) ? ucfirst($father->getRank()) : '' ?></td>
			<td><?= isset($father) ? $father->getLastName() : '' ?></td>
			<td><?= isset($father) ? $father->getFirstName() : '' ?></td>
			<td><?= isset($father) ? $father->getPhone() : '' ?></td>
			<td><?= isset($father) ? $father->getMail() : '' ?></td>
		</tr>
		<tr>
			<td><?= isset($mother) ? ucfirst($mother->getRank()) : '' ?></td>
			<td><?= isset($mother) ? $mother->getLastName() : '' ?></td>
			<td><?= isset($mother) ? $mother->getFirstName() : '' ?></td>
			<td><?= isset($mother) ? $mother->getPhone() : '' ?></td>
			<td><?= isset($mother) ? $mother->getMail() : '' ?></td>
		</tr>
		<tr>
			<td>Adresse</td>
			<td colspan="4"><?= $address ?></td>
		</tr>
	</table>

	<h3>Personnes autorisees a recuperer l'enfant</h3>

	<p>Nom : </p>
	<p>Prenom : </p>
	<p>N° CIN : </p>

	<h3>Medical</h3>

	<section>
		<h4>Allergies</h4>
		<p><?= $child->getAllergies() ?></p>
		
		<h4>Vaccins</h4>
		<p><?= $child->getVaccines() ?></p>
	</section>
</section>