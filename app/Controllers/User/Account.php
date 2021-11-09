<?php

namespace App\Controllers\User;

use App\Controllers\BaseController;
use App\Models\AccountModel;

class Account extends BaseController
{
	public function index()
	{
		return redirect()->to(base_url());
	}

	public function settings()
	{
		$data = [
			'title' => 'Akun - Pengaturan',
		];

		return view('user/account/settings', $data);
	}
}
