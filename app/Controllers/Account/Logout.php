<?php

namespace App\Controllers\Account;

use App\Controllers\BaseController;
use App\Models\AccountModel;

class Logout extends BaseController
{
	public function index()
	{
		\Config\Services::session()->destroy();

		return redirect()->to(base_url());
	}
}
