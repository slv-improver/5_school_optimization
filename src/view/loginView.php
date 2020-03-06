<?php $this->title = "Connexion"; ?>

<div>
	<?= $this->session->show('need_login'); ?>
	<?php require_once 'form_login.php'; ?>
</div>