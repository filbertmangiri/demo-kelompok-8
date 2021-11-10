<div class="container">
	<ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
		<li class="nav-item" role="presentation">
			<button class="nav-link active" id="pills-acc-all-tab" data-bs-toggle="pill" data-bs-target="#pills-acc-all" type="button" role="tab" aria-controls="pills-acc-all" aria-selected="true">Semua</button>
		</li>
		<li class="nav-item" role="presentation">
			<button class="nav-link" id="pills-acc-deleted-tab" data-bs-toggle="pill" data-bs-target="#pills-acc-deleted" type="button" role="tab" aria-controls="pills-acc-deleted" aria-selected="false">Terhapus</button>
		</li>
	</ul>

	<?php
	$session = session();

	if (!empty($session->getFlashData('admin_acc_error_msg'))) : ?>
		<svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
			<symbol id="exclamation-triangle-fill" fill="currentColor" viewBox="0 0 16 16">
				<path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"></path>
			</symbol>
		</svg>

		<div class="alert alert-danger alert-dismissible" role="alert">
			<svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:">
				<use xlink:href="#exclamation-triangle-fill">
			</svg>

			<?= $session->getFlashData('admin_acc_error_msg'); ?>

			<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
		</div>
	<?php endif; ?>

	<div class="tab-content" id="pills-tabContent">
		<div class="tab-pane fade show active" id="pills-acc-all" role="tabpanel" aria-labelledby="pills-acc-all-tab">
			<table id="accountsTable" class="table table-striped" style="width:100%">
				<thead>
					<tr>
						<th>ID</th>
						<th>Email</th>
						<th>Username</th>
						<th>Nama</th>
						<th>Tanggal Lahir</th>
						<th>Jenis Kelamin</th>
						<th>Admin</th>
						<th>Aksi</th>
					</tr>
				</thead>

				<tbody>
					<?php foreach ($accounts as $i => $key) : ?>
						<?php if ($key['deleted_at']) continue; ?>
						<tr>
							<td id="id"><?= $key['id']; ?></td>
							<td id="email"><?= $key['email']; ?></td>
							<td id="username">
								<a href="<?= base_url('u/' . $key['username']); ?>" title="Lihat Profil">
									<?= $key['username']; ?>
								</a>
							</td>
							<td id="full_name"><?= $key['first_name'] . ' ' . $key['last_name']; ?></td>
							<td id="birth_date"><?= $key['birth_date']; ?></td>
							<td id="gender"><?= $key['gender'] == 1 ? 'Perempuan' : 'Laki-laki'; ?></td>
							<td id="is_admin"><?= $key['is_admin'] == 1 ? 'Ya' : 'Tidak'; ?></td>
							<td>
								<i class="bi bi-person-circle" onclick="location.href = '<?= base_url('u/profile/' . $key['username']); ?>'" role="button" title="Lihat Profil"></i>
								<?php if ($key['id'] != $session->get('acc_id')) : ?>
									<!-- <i class="bi bi-tools text-dark" onclick="acc_edit($key['id'];, event);"></i> -->
									<i class="bi bi-trash text-danger" onclick="acc_delete(<?= $key['id']; ?>, event);" role="button" title="Hapus"></i>
								<?php endif; ?>
							</td>
						</tr>
					<?php endforeach; ?>
				</tbody>
			</table>
		</div>
		<div class="tab-pane fade" id="pills-acc-deleted" role="tabpanel" aria-labelledby="pills-acc-deleted-tab">
			<table id="deletedAccountsTable" class="table table-striped" style="width:100%">
				<thead>
					<tr>
						<th>ID</th>
						<th>Email</th>
						<th>Username</th>
						<th>Nama</th>
						<th>Tanggal Lahir</th>
						<th>Jenis Kelamin</th>
						<th>Admin</th>
						<th>Aksi</th>
					</tr>
				</thead>

				<tbody>
					<?php foreach ($accounts as $i => $key) : ?>
						<?php if (!$key['deleted_at']) continue; ?>
						<tr>
							<td id="id"><?= $key['id']; ?></td>
							<td id="email"><?= $key['email']; ?></td>
							<td id="username"><?= $key['username']; ?></td>
							<td id="full_name"><?= $key['first_name'] . ' ' . $key['last_name']; ?></td>
							<td id="birth_date"><?= $key['birth_date']; ?></td>
							<td id="gender"><?= $key['gender'] == 1 ? 'Perempuan' : 'Laki-laki'; ?></td>
							<td id="is_admin"><?= $key['is_admin'] == 1 ? 'Ya' : 'Tidak'; ?></td>
							<td>
								<i class="bi bi-arrow-counterclockwise text-primary" onclick="acc_restore(<?= $key['id']; ?>, event);" role="button" title="Pulihkan"></i>
								<i class="bi bi-trash text-danger" onclick="acc_delete(<?= $key['id']; ?>, event, true);" role="button" title="Hapus Permanen"></i>
							</td>
						</tr>
					<?php endforeach; ?>
				</tbody>
			</table>
		</div>
	</div>
</div>