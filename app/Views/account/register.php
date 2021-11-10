<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<div class="container col-6">
	<?php

	helper('form');

	$session = session();

	if ($session->get('register_error_msg')) : ?>
		<svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
			<symbol id="exclamation-triangle-fill" fill="currentColor" viewBox="0 0 16 16">
				<path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"></path>
			</symbol>
		</svg>

		<div class="alert alert-danger alert-dismissible" role="alert">
			<svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:">
				<use xlink:href="#exclamation-triangle-fill">
			</svg>

			<?= $session->get('register_error_msg'); ?>

			<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
		</div>
	<?php endif; ?>

	<?= form_open_multipart(base_url('account/register/insert'), ['id' => 'registerForm']); ?>

	<?= csrf_field(); ?>

	<div class="mb-4 text-center">
		<img src="<?= base_url('img/profile-pictures/default-male.png'); ?>" alt="Foto Profil" width="150px" id="currentProfile" class="img-thumbnail" role="button" title="Upload foto profil" style="border-radius: 50%;">
		<?= form_upload('profile_picture', '', ['id' => 'profilePicture', 'class' => 'form-control mb-3' . ($validation->hasError('profile_picture') ? ' is-invalid' : ''), 'style' => 'display: none;']); ?>

		<div class="invalid-feedback">
			<?= $validation->getError('profile_picture'); ?>
		</div>
	</div>

	<div class="form-floating mb-3">
		<?= form_input('email', (string) old('email'), ['placeholder' => ' ', 'class' => 'form-control' . ($validation->hasError('email') ? ' is-invalid' : ''), 'autofocus' => ''], 'email'); ?>
		<?= form_label('Email'); ?>

		<div class="invalid-feedback">
			<?= $validation->getError('email'); ?>
		</div>
	</div>

	<div class="form-floating mb-3">
		<?= form_input('username', (string) old('username'), ['placeholder' => ' ', 'class' => 'form-control' . ($validation->hasError('username') ? ' is-invalid' : '')]); ?>
		<?= form_label('Username'); ?>

		<div class="invalid-feedback">
			<?= $validation->getError('username'); ?>
		</div>
	</div>

	<div class="row mb-3">
		<div class="col-6">
			<div class="form-floating mb-3">
				<?= form_password('password', '', ['placeholder' => ' ', 'class' => 'form-control' . ($validation->hasError('password') ? ' is-invalid' : '')]); ?>
				<?= form_label('Password'); ?>

				<div class="invalid-feedback">
					<?= $validation->getError('password'); ?>
				</div>
			</div>
		</div>

		<div class="col-6">
			<div class="form-floating mb-3">
				<?= form_password('password_confirm', '', ['placeholder' => ' ', 'class' => 'form-control' . ($validation->hasError('password_confirm') ? ' is-invalid' : '')]); ?>
				<?= form_label('Konfirmasi Password'); ?>

				<div class="invalid-feedback">
					<?= $validation->getError('password_confirm'); ?>
				</div>
			</div>
		</div>
	</div>

	<div class="row mb-3">
		<div class="col-6">
			<div class="form-floating mb-3">
				<?= form_input('first_name', (string) old('first_name'), ['placeholder' => ' ', 'class' => 'form-control' . ($validation->hasError('first_name') ? ' is-invalid' : '')]); ?>
				<?= form_label('Nama Depan'); ?>

				<div class="invalid-feedback">
					<?= $validation->getError('first_name'); ?>
				</div>
			</div>
		</div>

		<div class="col-6">
			<div class="form-floating mb-3">
				<?= form_input('last_name', (string) old('last_name'), ['placeholder' => ' ', 'class' => 'form-control' . ($validation->hasError('last_name') ? ' is-invalid' : '')]); ?>
				<?= form_label('Nama Belakang'); ?>

				<div class="invalid-feedback">
					<?= $validation->getError('last_name'); ?>
				</div>
			</div>
		</div>
	</div>

	<div class="form-floating mb-3">
		<?= form_input('birth_date', (string) old('birth_date'), ['placeholder' => ' ', 'class' => 'form-control' . ($validation->hasError('birth_date') ? ' is-invalid' : '')], 'date'); ?>
		<?= form_label('Nama Depan'); ?>

		<div class="invalid-feedback">
			<?= $validation->getError('birth_date'); ?>
		</div>
	</div>

	<div class="form-group mb-4">
		<div class="form-check form-check-inline">
			<?= form_radio('gender', '0', !((bool) old('gender')), ['class' => 'form-check-input', 'id' => 'genderMale']); ?>
			<?= form_label('Laki-laki', 'genderMale', ['class' => 'form-check-label']); ?>
		</div>

		<div class="form-check form-check-inline">
			<?= form_radio('gender', '1', (bool) old('gender'), ['class' => 'form-check-input', 'id' => 'genderFemale']); ?>
			<?= form_label('Perempuan', 'genderFemale', ['class' => 'form-check-label']); ?>
		</div>
	</div>

	<?= form_submit([
		'value' => 'Daftar',
		'class' => 'btn btn-primary col-12 mb-5',
	]); ?>

	<?= form_close(); ?>
</div>

<?= $this->endSection(); ?>

<?= $this->section('scripts'); ?>

<script type="text/javascript">
	$(document).ready(function() {
		$('#currentProfile').click(function() {
			$('#profilePicture').click();
		});

		$('#profilePicture').on('change', function(event) {
			const [file] = $(this).prop('files');
			if (file) {
				$('#currentProfile').attr('src', URL.createObjectURL(file));
			}
		});
	});
</script>

<?= $this->endSection(); ?>