<?php

namespace App\Controllers\Account;

use App\Controllers\BaseController;
use App\Models\AccountModel;

class Login extends BaseController
{
	protected $accountModel;

	private $session;

	public function __construct()
	{
		$this->accountModel = new AccountModel();
		$this->session = session();
	}

	public function index()
	{
		session();

		$data = [
			'title' => 'Masuk'
		];

		return view('account/login', $data);
	}

	public function check()
	{
		if (!$this->validate([
			'email_username' => 'required',
			'password' => 'required'
		])) {
			return redirect()->to(base_url('account/login'))->withInput()->with('login_error_msg', 'Username atau password salah');
		}

		$account = $this->accountModel->getAccount($this->request->getPost());

		if ($account) {
			$this->session->set('acc_id', $account['id']);

			$this->session->set('acc_email', $account['email']);
			$this->session->set('acc_username', $account['username']);
			$this->session->set('acc_first_name', $account['first_name']);
			$this->session->set('acc_last_name', $account['last_name']);
			$this->session->set('acc_birth_date', $account['birth_date']);
			$this->session->set('gender', (bool) $account['gender']);
			$this->session->set('is_admin', (bool) $account['is_admin']);

			$this->session->set('is_logged_in', true);

			$this->session->remove('login_error_msg');
		} else {
			return redirect()->to(base_url('account/login'))->withInput()->with('login_error_msg', 'Username atau password salah');
		}

		return redirect()->to(base_url());
	}
}
