<?php $session = \Config\Services::session(); ?>

<nav class="navbar sticky-top navbar-expand-lg navbar-light bg-light">
	<div class="container">
		<a class="navbar-brand" href="<?= base_url(); ?>">Kelompok 8</a>

		<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>

		<div class="collapse navbar-collapse" id="navbarSupportedContent">
			<ul class="navbar-nav me-auto mb-2 mb-lg-0">
				<li class="nav-item">
					<a class="nav-link" href="<?= base_url(); ?>">Beranda</a>
				</li>

				<?php if ($session->get('is_logged_in') === true && $session->get('is_admin') === true) : ?>
					<li class="nav-item">
						<a class="nav-link" href="<?= base_url('admin'); ?>">Admin</a>
					</li>
				<?php endif; ?>
			</ul>

			<ul class="navbar-nav ms-auto mb-2 mb-lg-0">
				<?php if ($session->get('is_logged_in') === true) : ?>
					<li class="nav-item dropdown">
						<a class="nav-link" href="#" id="myAccount" role="button" data-bs-toggle="dropdown" aria-expanded="false">
							<i class="bi bi-person-circle"></i>
						</a>
						<ul class="dropdown-menu dropdown-menu-end" aria-labelledby="myAccount">
							<li><a class="dropdown-item" href="<?= base_url('u/profile/' . session()->get('acc_username')); ?>">Profil</a></li>
							<li><a class="dropdown-item" href="<?= base_url('u/account/settings'); ?>">Pengaturan</a></li>
							<li>
								<hr class="dropdown-divider">
							</li>
							<li><a class="dropdown-item" href="<?= base_url('account/logout'); ?>">Keluar</a></li>
						</ul>
					</li>
				<?php else : ?>
					<li class="nav-item">
						<a class="nav-link" href="<?= base_url('account/login'); ?>">Masuk</a>
					</li>

					<li class="nav-item">
						<a class="nav-link" href="<?= base_url('account/register'); ?>">Daftar</a>
					</li>
				<?php endif; ?>
			</ul>
		</div>
	</div>
</nav>