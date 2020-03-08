<?php $title = "Fiche de l\'enfant"; ?>
<?php
$lastName = $child->getLastName();
$firstName = $child->getFirstName();
$birthDate = $child->getBirthDate();
$diff = $child->getBirthDate()->diff(new DateTime());
?>

<p><?= $lastName ?> <?= $firstName ?> : né le <?= $birthDate->format('d/m/Y') ?><br>
<?= $diff->y ?> ans <?= $diff->m ?> mois <?= $diff->d ?> jours</p>