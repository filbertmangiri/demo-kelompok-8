<?php

namespace App\Controllers\Account;

use App\Controllers\BaseController;

class Logout extends BaseController
{
	private $session;

	public function __construct()
	{
		$this->session = session();
	}

	public function index()
	{
		$this->session->destroy();

		return redirect()->to(base_url());
	}
}
