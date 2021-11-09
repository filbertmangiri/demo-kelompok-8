<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\AccountModel;

class Account extends BaseController
{
	protected $accountModel;

	private $session;

	public function __construct()
	{
		$this->accountModel = new AccountModel();
		$this->session = \Config\Services::session();
	}

	public function index()
	{
		$data = [
			'title' => 'Admin - Akun',
			'accounts' => $this->accountModel->getAccount()
		];

		return view('admin/account/index', $data);
	}

	public function delete($purge = false)
	{
		$id = $this->request->getPost('id');

		if ($id > 0) {
			$error_msg = $this->accountModel->deleteAccount($id, (bool) $purge);

			if (empty($error_msg)) {
				$this->session->remove('admin_acc_error_msg');
			} else {
				$this->session->setFlashdata('admin_acc_error_msg', $error_msg);
			}
		}
	}

	public function restore()
	{
		$id = $this->request->getPost('id');

		if ($id > 0) {
			$error_msg = $this->accountModel->restoreAccount($id);

			if (empty($error_msg)) {
				$this->session->remove('admin_acc_error_msg');
			} else {
				$this->session->setFlashdata('admin_acc_error_msg', $error_msg);
			}
		}
	}
}
