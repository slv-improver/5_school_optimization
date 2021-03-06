<?php $title = 'Enregistrement des présences'; ?>

<a href="?route=listChildren"><img class="icon" src="https://img.icons8.com/material-outlined/50/000000/home--v2.png" /></a>

<p>Enregistrez les absences/présences des enfants</p>

<table id="attendanceTable">
	<thead>
		<tr>
			<th>NOM</th>
			<th>Prenom</th>
			<th>Présence</th>
		</tr>
	</thead>
	<?php foreach ($children as $child) : ?>
		<tr>
			<form action="index.php?route=attendance&amp;childId=<?= $child->getId() ?>" method="post">
				<td><?= $child->getLastName() ?></td>
				<td><?= $child->getFirstName() ?></td>
				<td>
					<label for="val-1_<?= $child->getId() ?>" class="intd">Non renseigné<input type="radio" name="attendanceAmount" value="-1" id="val-1_<?= $child->getId() ?>" checked></label>
					<label for="val0_<?= $child->getId() ?>" class="intd">Absent<input type="radio" name="attendanceAmount" value="0" id="val0_<?= $child->getId() ?>"></label>
					<label for="val05_<?= $child->getId() ?>" class="intd">Mi-journée<input type="radio" name="attendanceAmount" value="0.5" id="val05_<?= $child->getId() ?>"></label>
					<label for="val1_<?= $child->getId() ?>" class="intd">Présent<input type="radio" name="attendanceAmount" value="1" id="val1_<?= $child->getId() ?>"></label>
				</td>
				<td>
					<input type="image" src="images/checkmark.png" name="submit" value="Enregistrer" class="attendance icon">
				</td>
			</form>
		</tr>
	<?php endforeach; ?>
	<tr class="center">
		<th colspan="3" class="split">Enregistrés</th>
	</tr>
	<?php foreach ($childrenHaveAttendance as $child) : ?>
		<tr class="haveAttendance">
			<form action="index.php?route=attendance&amp;childId=<?= $child->getId() ?>" method="post">
				<td><?= $child->getLastName() ?></td>
				<td><?= $child->getFirstName() ?></td>
				<td>
					<label for="val-1_<?= $child->getId() ?>" class="intd">Non renseigné<input type="radio" name="attendanceAmount" value="-1" id="val-1_<?= $child->getId() ?>" checked></label>
					<label for="val0_<?= $child->getId() ?>" class="intd">Absent<input type="radio" name="attendanceAmount" value="0" id="val0_<?= $child->getId() ?>"></label>
					<label for="val05_<?= $child->getId() ?>" class="intd">Mi-journée<input type="radio" name="attendanceAmount" value="0.5" id="val05_<?= $child->getId() ?>"></label>
					<label for="val1_<?= $child->getId() ?>" class="intd">Présent<input type="radio" name="attendanceAmount" value="1" id="val1_<?= $child->getId() ?>"></label>
				</td>
				<td>
					<input type="image" src="images/resave.png" name="submit" value="Réctifier" class="attendance icon">
				</td>
			</form>
		</tr>
	<?php endforeach; ?>
</table>