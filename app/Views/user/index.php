<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<div class="container col-6 text-center">
	<div class="card mx-auto" style="width: 18rem;">
		<img src="<?= base_url('img/profile-pictures/' . $account['profile_picture']); ?>" class="card-img-top" alt="Foto Profil <?= $account['username']; ?>" title="Foto profil <?= $account['username']; ?>">
		<div class="card-body">
			<h5 class="card-title"><?= $account['first_name'] . ' ' . $account['last_name']; ?></h5>
			<p class="card-text">
				<?= $account['id']; ?> <br>
				<?= $account['email']; ?> <br>
				<?= $account['username']; ?>
			</p>
		</div>
		<ul class="list-group list-group-flush">
			<li class="list-group-item"><?= $account['birth_date']; ?></li>
			<li class="list-group-item"><?= $account['gender'] == 1 ? 'Perempuan' : 'Laki-laki'; ?></li>
			<li class="list-group-item"><?= $account['is_admin'] == 1 ? 'Admin' : 'Bukan Admin'; ?></li>
		</ul>
	</div>
</div>

<?= $this->endSection(); ?>