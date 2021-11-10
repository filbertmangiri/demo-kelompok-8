<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<div class="container col-6 text-center">
	<div class="card mx-auto" style="width: 18rem;">
		<img src="..." class="card-img-top" alt="...">
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