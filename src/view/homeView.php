<?php

use App\src\model\Child;

$title = 'Enfants de l\'école'; ?>

<p>Liste des enfants :</p>

<table>
	<thead>
		<tr>
			<th>Nom</th>
			<th>Prenom</th>
			<th>Date de naissance</th>
			<th>Age</th>
		</tr>
	</thead>

	<tbody>
		<?php foreach ($children as $childArray) : 
			$child = new Child($childArray);
		?>
		<tr>
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
		</tr>
		<?php endforeach; ?>
	</tbody>
</table>