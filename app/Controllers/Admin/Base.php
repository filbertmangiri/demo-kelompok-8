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
		$data = [
			'title' => 'Admin'
		];

		return view('admin/index', $data);
	}
}
