<?php

use App\src\model\Child;

$title = 'Enfants de l\'école'; ?>

<p>Liste des <?= count($children) ?> enfants :</p>

<p>
	<?= $this->session->show('add_child') ?>
	<?= $this->session->show('delete_child') ?>
</p>

<table>
	<thead>
		<tr>
			<th>N°</th>
			<th>Nom</th>
			<th>Prenom</th>
			<th>Date de naissance</th>
			<th>Age</th>
			<td><a href="index.php?route=addChild">Ajouter</a></td>
		</tr>
	</thead>

	<tbody>
		<?php
		$count = 0;
		foreach ($children as $childArray) :
			$child = new Child($childArray);
			$count++;
		?>
			<tr>
				<td> <?= $count ?> </td>
				<td class="left">
					<?= strtoupper($child->getLastName()) ?>
				</td>
				<td class="right">
					<?= ucfirst($child->getFirstName()) ?>
				</td>
				<td class="center">
					<?= $child->getBirthDate()->format('d . m . Y'); ?>
				</td>
				<td>
					<?php $diff = $child->getBirthDate()->diff(new DateTime());
					echo "$diff->y ans $diff->m mois $diff->d jours";
					?>
				</td>
				<td>
					<a href="index.php?route=deleteChild&amp;childId=<?= $child->getId() ?>">Supprimer</a>
				</td>
			</tr>
		<?php endforeach; ?>
	</tbody>
</table>