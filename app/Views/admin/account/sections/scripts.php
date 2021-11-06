<script src="https://code.jquery.com/ui/1.13.0/jquery-ui.min.js" integrity="sha256-hlKLmzaRlE8SCJC1Kw8zoUbU8BxA+8kR3gseuKfMjxA=" crossorigin="anonymous"></script>

<script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap5.min.js"></script>

<script type="text/javascript">
	$(document).ready(function() {
		$('#accountsTable').DataTable();
		$('#deleteModal').modal('hide');

		$('#deletedAccountsTable').DataTable();
		$('#restoreModal').modal('hide');
	});

	// Hapus Akun
	function acc_delete(id, event) {
		let confirm = $('#deleteModal .modal-body');
		let detail = $(event.target).closest('tr');

		confirm.html('Konfirmasi penghapusan akun dengan detail sebagai berikut : <br><br>');
		confirm.append('<span class="tab-align">ID</span> = ' + detail.children('#id').text() + '<br>');
		confirm.append('<span class="tab-align">Email</span> = ' + detail.children('#email').text() + '<br>');
		confirm.append('<span class="tab-align">Username</span> = ' + detail.children('#username').text() + '<br>');
		confirm.append('<span class="tab-align">Nama</span> = ' + detail.children('#first_name').text() + ' ' + detail.children('#last_name').text() + '<br>');
		confirm.append('<span class="tab-align">Tanggal Lahir</span> = ' + detail.children('#birth_date').text() + '<br>');
		confirm.append('<span class="tab-align">Jenis Kelamin</span> = ' + detail.children('#gender').text() + '<br>');
		confirm.append('<span class="tab-align">Admin</span> = ' + detail.children('#is_admin').text() + '<br>');

		$('#accDeleteBtn').parent().attr('onsubmit', 'acc_delete_confirm(' + id + ')');

		$('#deleteModal').modal('show');
	}

	function acc_delete_confirm(id) {
		if (id < 1) {
			alert('ID akun tidak valid');
			return;
		}

		$.ajax({
			url: '<?= base_url('admin/account/delete') ?>',
			type: 'POST',
			data: {
				'id': id
			}
		});

		$('#deleteModal').modal('hide');
	}

	// Restore Akun
	function acc_restore(id, event) {
		let confirm = $('#restoreModal .modal-body');
		let detail = $(event.target).closest('tr');

		confirm.html('Konfirmasi pemulihan akun dengan detail sebagai berikut : <br><br>');
		confirm.append('<span class="tab-align">ID</span> = ' + detail.children('#id').text() + '<br>');
		confirm.append('<span class="tab-align">Email</span> = ' + detail.children('#email').text() + '<br>');
		confirm.append('<span class="tab-align">Username</span> = ' + detail.children('#username').text() + '<br>');
		confirm.append('<span class="tab-align">Nama</span> = ' + detail.children('#first_name').text() + ' ' + detail.children('#last_name').text() + '<br>');
		confirm.append('<span class="tab-align">Tanggal Lahir</span> = ' + detail.children('#birth_date').text() + '<br>');
		confirm.append('<span class="tab-align">Jenis Kelamin</span> = ' + detail.children('#gender').text() + '<br>');
		confirm.append('<span class="tab-align">Admin</span> = ' + detail.children('#is_admin').text() + '<br>');

		$('#accRestoreBtn').parent().attr('onsubmit', 'acc_restore_confirm(' + id + ')');

		$('#restoreModal').modal('show');
	}

	function acc_restore_confirm(id) {
		if (id < 1) {
			alert('ID akun tidak valid');
			return;
		}

		$.ajax({
			url: '<?= base_url('admin/account/restore') ?>',
			type: 'POST',
			data: {
				'id': id
			}
		});

		$('#restoreModal').modal('hide');
	}
</script>