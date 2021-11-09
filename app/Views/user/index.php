<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<div class="container col-6">
	<table>
		<tbody>
			<tr>
				<td>ID</td>
				<td> </td>
				<td>:</td>
				<td><?= $account['id']; ?></td>
			</tr>
			<tr>
				<td>Email</td>
				<td> </td>
				<td>:</td>
				<td><?= $account['email']; ?></td>
			</tr>
			<tr>
				<td>Username</td>
				<td> </td>
				<td>:</td>
				<td><?= $account['username']; ?></td>
			</tr>
			<tr>
				<td>Nama</td>
				<td> </td>
				<td>:</td>
				<td><?= $account['first_name'] . ' ' . $account['last_name']; ?></td>
			</tr>
			<tr>
				<td>Tanggal Lahir</td>
				<td> </td>
				<td>:</td>
				<td><?= $account['birth_date']; ?></td>
			</tr>
			<tr>
				<td>Jenis Kelamin</td>
				<td> </td>
				<td>:</td>
				<td><?= $account['gender'] == 1 ? 'Perempuan' : 'Laki-laki'; ?></td>
			</tr>
			<tr>
				<td>Admin</td>
				<td> </td>
				<td>:</td>
				<td><?= $account['is_admin'] == 1 ? 'Ya' : 'Tidak'; ?></td>
			</tr>
		</tbody>
	</table>
</div>

<?= $this->endSection(); ?>