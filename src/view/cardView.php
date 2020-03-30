<?php $title = "Fiche de l\'enfant"; ?>
<?php
$lastName = $child->getLastName();
$firstName = $child->getFirstName();
$birthDate = $child->getBirthDate();
$address = $child->getAddress() ?? '';
$diff = $child->getBirthDate()->diff(new DateTime());
$gender = $child->getGender() === 'm' ? '' : 'e';
$father = $child->getFather();
$mother = $child->getMother();
$attendance = $child->getAttendance();
?>

<a href="index.php?route=listChildren"><img class="icon" src="https://img.icons8.com/material-outlined/50/000000/home--v2.png" /></a>
<h2 class='center'><?= $lastName ?> <?= $firstName ?></h2>
<p>
	né<?= $gender ?> le <?= $birthDate->format('d/m/Y') ?><br>
	<?= $diff->y ?> ans <?= $diff->m ?> mois <?= $diff->d ?> jours
</p>
<p>
	Pourcentage de présence depuis le 
	<?= isset($attendance->getDay()[0]) ? $attendance->getDay()[0]->format('d/m/Y') : '' ?> : 
	<?= $attendance->getPercent() ?>
</p>

<section class="info">
	<h2 class='center'>Informations Administratives</h2>

	<table class="parent">
		<tr>
			<th class="no-border"></th>
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

	<h3>Medical</h3>

	<section>
		<h4>Allergies</h4>
		<p><?= $child->getAllergies() ?></p>

		<h4>Vaccins</h4>
		<p><?= $child->getVaccines() ?></p>

		<h4>Autres Informations</h4>
		<p><?= $child->getOther() ?></p>
	</section>
</section>

<section>
	<h2 class='center'>Documents</h2>
	<form action="index.php?route=addDocument&amp;childId=<?= $child->getId() ?>" method="post" enctype="multipart/form-data">
		<label for="title">Titre du document</label>
		<input type="text" name="title" id="title" /><br />
		<input type="file" name="document" /><br />
		<input type="submit" name="submit" value="Intégrer le document à la fiche de l'enfant" />
	</form>

	<?php
	foreach ($child->getDocuments() as $document) :
	?>

		<h3><?= $document['title'] ?></h3>
		<p><img src="uploads/<?= $document['url'] ?>" alt="document administratif"></p>
	<?php endforeach ?>

</section>