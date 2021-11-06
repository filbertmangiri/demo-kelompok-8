<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class Base extends BaseController
{
	private $session;

	public function __construct()
	{
		$this->session = \Config\Services::session();
	}

	public function index()
	{
		if ($this->session->get('is_admin') !== true) {
			return redirect()->to(base_url());
		}

		$data = [
			'title' => 'Admin'
		];

		return view('admin/index', $data);
	}
}
