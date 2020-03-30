<?php $title = 'Enfants de l\'école'; ?>

<p>Liste des <?= count($children) ?> enfants :</p>

<p>
	<?= $this->session->show('add_child') ?>
	<?= $this->session->show('delete_child') ?>
</p>

<table>
	<thead>
		<tr align="center">
			<th class="no-border"></th>
			<td><a href="index.php?route=attendance"><img class="icon" src="images/check.png" /></a></td>
			<th>Nom</th>
			<th>Prenom</th>
			<th>Date de naissance</th>
			<th>Age</th>
			<td><a href="index.php?route=addChild"><img class="icon" src="images/add.png" /></a></td>
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
				<td><?= $child->getAttendance()->getPercent() ?></td>
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
					<a class="delete" href="index.php?route=deleteChild&amp;childId=<?= $child->getId() ?>"><img class="icon" src="images/delete.png" /></a>
				</td>
				<td>
					<a href="index.php?route=childCard&amp;childId=<?= $child->getId() ?>"><img class="icon" src="images/arrow.png" /><img class="icon" src="images/document.png" /></a>
				</td>
			</tr>
		<?php endforeach; ?>
	</tbody>
</table>
<div class="pagination">
	<?php for ($i = 1; $i <= $numberOfPages; $i++) :
		$separator = $i < $numberOfPages ? '&nbsp;-&nbsp;' : ' ';
	?>
		<a href="index.php?route=listChildren&amp;p=<?= $i ?>"><?= $i ?></a><?= $separator ?>
	<?php endfor ?>
</div>