<script src="https://code.jquery.com/ui/1.13.0/jquery-ui.min.js" integrity="sha256-hlKLmzaRlE8SCJC1Kw8zoUbU8BxA+8kR3gseuKfMjxA=" crossorigin="anonymous"></script>

<script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap5.min.js"></script>

<script type="text/javascript">
	let accountsTable;
	let deletedAccountsTable;

	$(document).ready(function() {
		accountsTable = $('#accountsTable').DataTable();
		$('#deleteModal').modal('hide');

		deletedAccountsTable = $('#deletedAccountsTable').DataTable();
		$('#restoreModal').modal('hide');
	});

	// Delete Account
	function acc_delete(id, event, purge = false) {
		acc_detail_modal(
			(purge ? deletedAccountsTable : accountsTable),
			event,
			'Hapus' + (purge ? ' Permanen' : '') + ' Akun',
			'hapus ' + (purge ? 'permanen' : '') + '', {
				html: 'Hapus' + (purge ? ' Permanen' : ''),
				color: 'btn-danger',
				onsubmit: 'acc_delete_confirm(' + id + ', ' + purge + ')'
			}
		);
	}

	function acc_delete_confirm(id, purge = false) {
		if (id < 1) {
			alert('ID akun tidak valid');
			return;
		}

		$.ajax({
			url: ('<?= base_url('admin/account/delete'); ?>' + (purge ? '/1' : '')),
			type: 'POST',
			data: {
				'id': id
			}
		});

		$('#deleteModal').modal('hide');
	}

	// Restore Account
	function acc_restore(id, event) {
		acc_detail_modal(
			deletedAccountsTable,
			event,
			'Pulihkan Akun',
			'pemulihan', {
				html: 'Pulihkan',
				color: 'btn-primary',
				onsubmit: 'acc_restore_confirm(' + id + ')'
			},
		);

		$('#baseModalBtn').addClass('btn-primary').removeClass('btn-danger');
	}

	function acc_restore_confirm(id) {
		if (id < 1) {
			alert('ID akun tidak valid');
			return;
		}

		$.ajax({
			url: '<?= base_url('admin/account/restore'); ?>',
			type: 'POST',
			data: {
				'id': id
			}
		});

		$('#restoreModal').modal('hide');
	}

	function acc_detail_modal(table, event, label = '', confirm = '', button = {
		html: '',
		color: 'btn-primary',
		onsubmit: ''
	}) {
		let modal = $('#baseModal');

		// Set the modal's label
		modal.find('#baseModalLabel').html(label);

		// Set the modal's body content
		let body = modal.find('.modal-body');
		let columns = [
			'ID',
			'Email',
			'Username',
			'Nama',
			'Tanggal Lahir',
			'Jenis Kelamin',
			'Admin'
		];

		body.html('Konfirmasi ' + confirm + ' akun dengan detail sebagai berikut : <br><br>');

		let row = table.row(event.target.closest('tr')).data();

		for (let i = 0, len = row.length - 1; i < len; i++) {
			body.append('<span class="tab-align">' + columns[i] + '</span> = ' + row[i] + '<br>');
		}

		// Set the modal button's html and functionality
		let btn = modal.find('#baseModalBtn');

		btn.html(button.html);

		btn.removeClass(function(index, className) {
			return (className.match(/(^|\s)color-\S+/g) || []).join(' ');
		}).addClass(button.color);

		btn.closest('form').attr('onsubmit', button.onsubmit);

		// Show the modal
		modal.modal('show');
	}
</script>