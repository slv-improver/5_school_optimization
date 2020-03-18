<?php $title = 'Enfants de l\'école'; ?>

<p>Liste des <?= count($children) ?> enfants :</p>

<p>
	<?= $this->session->show('add_child') ?>
	<?= $this->session->show('delete_child') ?>
</p>

<table>
	<thead>
		<tr align="center">
			<th>N°</th>
			<td><a href="index.php?route=attendance"><img src="https://img.icons8.com/color/30/000000/inspection.png" /></a></td>
			<th>Nom</th>
			<th>Prenom</th>
			<th>Date de naissance</th>
			<th>Age</th>
			<td><a href="index.php?route=addChild"><img src="https://img.icons8.com/cotton/30/000000/plus--v1.png" /></a></td>
		</tr>
	</thead>

	<tbody>
		<?php
		$count = 0;
		foreach ($children as $child) :
			$count++;
		?>
			<tr>
				<td><?= $count ?></td>
				<td><?= $child->getAttendance()->getPercent() ?>%</td>
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
				<td align="center">
					<a href="index.php?route=deleteChild&amp;childId=<?= $child->getId() ?>"><img src="https://img.icons8.com/cotton/30/000000/minus--v1.png" /></a>
				</td>
				<td>
					<a href="index.php?route=childCard&amp;childId=<?= $child->getId() ?>"><img src="https://img.icons8.com/android/30/000000/long-arrow-right.png" /><img src="https://img.icons8.com/carbon-copy/30/000000/document.png" /></a>
				</td>
			</tr>
		<?php endforeach; ?>
	</tbody>
</table>