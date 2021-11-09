<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<div class="container col-6">
	<form id="registerForm" action="<?= base_url('account/register/insert'); ?>" method="post">
		<?= csrf_field(); ?>

		<div class="form-floating mb-3">
			<input type="text" class="form-control <?= $validation->hasError('email') ? 'is-invalid' : ''; ?>" id="email" name="email" placeholder="email" value="<?= old('email'); ?>" autofocus>
			<label for="email">Email</label>

			<div class="invalid-feedback">
				<?= $validation->getError('email'); ?>
			</div>
		</div>

		<div class="form-floating mb-3">
			<input type="text" class="form-control <?= $validation->hasError('username') ? 'is-invalid' : ''; ?>" id="username" name="username" placeholder="username" value="<?= old('username'); ?>">
			<label for="username">Username</label>

			<div class="invalid-feedback">
				<?= $validation->getError('username'); ?>
			</div>
		</div>

		<div class="row mb-3">
			<div class="col-6">
				<div class="form-floating mb-3">
					<input type="password" class="form-control <?= $validation->hasError('password') ? 'is-invalid' : ''; ?>" id="password" name="password" placeholder="password">
					<label for="password">Password</label>

					<div class="invalid-feedback">
						<?= $validation->getError('password'); ?>
					</div>
				</div>
			</div>

			<div class="col-6">
				<div class="form-floating mb-3">
					<input type="password" class="form-control <?= $validation->hasError('password_confirm') ? 'is-invalid' : ''; ?>" id="passwordConfirm" name="password_confirm" placeholder="passwordConfirm">
					<label for="passwordConfirm">Konfirmasi Password</label>

					<div class="invalid-feedback">
						<?= $validation->getError('password_confirm'); ?>
					</div>
				</div>
			</div>
		</div>

		<div class="row mb-3">
			<div class="col-6">
				<div class="form-floating">
					<input type="text" class="form-control <?= $validation->hasError('first_name') ? 'is-invalid' : ''; ?>" id="firstName" name="first_name" placeholder="firstName" value="<?= old('first_name'); ?>">
					<label for="firstName">Nama Depan</label>

					<div class="invalid-feedback">
						<?= $validation->getError('first_name'); ?>
					</div>
				</div>
			</div>

			<div class="col-6">
				<div class="form-floating">
					<input type="text" class="form-control <?= $validation->hasError('last_name') ? 'is-invalid' : ''; ?>" id="lastName" name="last_name" placeholder="lastName" value="<?= old('last_name'); ?>">
					<label for="lastName">Nama Belakang</label>

					<div class="invalid-feedback">
						<?= $validation->getError('last_name'); ?>
					</div>
				</div>
			</div>
		</div>

		<div class="form-floating mb-3">
			<input type="date" class="form-control <?= $validation->hasError('birth_date') ? 'is-invalid' : ''; ?>" id="birthDate" name="birth_date" placeholder="birthDate" value="<?= old('birth_date'); ?>">
			<label for="birthDate">Tanggal Lahir</label>

			<div class="invalid-feedback">
				<?= $validation->getError('birth_date'); ?>
			</div>
		</div>

		<div class="form-group mb-5">
			<div class="form-check form-check-inline">
				<input class="form-check-input" type="radio" name="gender" id="genderMale" value="0" <?= ((bool) old('gender')) ? '' : 'checked'; ?>>
				<label class="form-check-label" for="genderMale">
					Laki-laki
				</label>
			</div>

			<div class="form-check form-check-inline">
				<input class="form-check-input" type="radio" name="gender" id="genderFemale" value="1" <?= ((bool) old('gender')) ? 'checked' : ''; ?>>
				<label class="form-check-label" for="genderFemale">
					Perempuan
				</label>
			</div>
		</div>

		<button type="submit" class="btn btn-primary col-12">DAFTAR</button>
	</form>
</div>

<?= $this->endSection(); ?>