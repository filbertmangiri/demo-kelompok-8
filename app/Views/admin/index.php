<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<div class="container">
	<div class="row">
		<div class="col">
			<h1>Halaman Utama Admin</h1>
			<a class="btn btn-primary" href="<?= base_url('admin/account'); ?>">Pengaturan Akun</a>
		</div>
	</div>
</div>

<?= $this->endSection(); ?>