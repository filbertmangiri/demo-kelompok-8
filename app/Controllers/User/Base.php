<?php

namespace App\Controllers\User;

use App\Controllers\BaseController;
use App\Models\AccountModel;

class Base extends BaseController
{
	protected $accountModel;

	public function __construct()
	{
		$this->accountModel = new AccountModel();
	}

	public function index($username = '')
	{
		return redirect()->to(base_url());
	}

	public function profile($username = '')
	{
		if (empty($username)) {
			return redirect()->to(base_url('u/profile/' . session()->get('acc_username')));
		}

		$account = $this->accountModel->getAccount(['username' => $username]);

		if (!$account) {
			return throw new \Exception('Akun \'' . $username . '\' tidak ditemukan.', 404);
		}

		$data = [
			'title' => 'User',
			'account' => $account
		];

		return view('user/index', $data);
	}
}
