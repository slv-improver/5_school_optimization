<?php $title = 'Enregistrement des présences'; ?>

<p>Enregistrez les absences/présences des enfants</p>

<table>
	<tr>
		<th>NOM</th>
		<th>Prenom</th>
		<th>Présence</th>
	</tr>
<?php foreach ($children as $child) : ?>
	<tr>
		<form action="index.php?route=attendance&amp;childId=<?= $child->getId() ?>" method="post">
		<td><?= $child->getLastName() ?></td>
		<td><?= $child->getFirstName() ?></td>
		<td>
				<label for="val-1_<?= $child->getId() ?>" class="intd">Non renseigné<input type="radio" name="attendanceAmount" value="-1" id="val-1_<?= $child->getId() ?>" checked></label>
				<label for="val-1<?= $child->getId() ?>" class="intd">Non renseigné<input type="radio" name="attendanceAmount<?= $child->getId() ?>" value="-1" id="val-1<?= $child->getId() ?>" checked></label>
				<label for="val0<?= $child->getId() ?>" class="intd">Absent<input type="radio" name="attendanceAmount<?= $child->getId() ?>" value="0" id="val0<?= $child->getId() ?>"></label>
				<label for="val05<?= $child->getId() ?>" class="intd">Mi-journée<input type="radio" name="attendanceAmount<?= $child->getId() ?>" value="0.5" id="val05<?= $child->getId() ?>"></label>
				<label for="val1<?= $child->getId() ?>" class="intd">Présent<input type="radio" name="attendanceAmount<?= $child->getId() ?>" value="1" id="val1<?= $child->getId() ?>"></label>
		</td>
		<td>
			<input type="submit" name="submit" value="Enregistrer">
		</td>
		</td>
		</form>
	</tr>
	<?php endforeach; ?>
</table>