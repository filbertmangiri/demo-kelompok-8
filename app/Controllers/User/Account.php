<?php

namespace App\Controllers\User;

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
		return redirect()->to(base_url());
	}

	public function settings()
	{
		session();

		$data = [
			'title' => 'Akun - Pengaturan',
			'account' => $this->accountModel->getAccount(['id' => session()->get('acc_id')]),
			'validation' => \Config\Services::validation()
		];

		return view('user/account/settings', $data);
	}

	public function update()
	{
		$id = $this->session->get('acc_id');

		if (!$this->validate([
			'email' => 'required|valid_email|is_unique[accounts.email,id,' . $id . ']',
			'username' => 'required|alpha_numeric|min_length[5]|max_length[50]|is_unique[accounts.username,id,' . $id . ']',
			'first_name' => 'required|alpha_space|min_length[2]',
			'last_name' => 'alpha_space',
			'birth_date' => 'required|valid_date|less_than_today',
			'gender' => 'required'
		])) {
			$validation = \Config\Services::validation();
			return redirect()->to(base_url('u/account/settings'))->withInput()->with('validation', $validation);
		}

		$this->accountModel->updateAccount($id, $this->request->getPost());

		$this->session->set('acc_email', $this->request->getPost('email'));
		$this->session->set('acc_username', $this->request->getPost('username'));
		$this->session->set('acc_first_name', $this->request->getPost('first_name'));
		$this->session->set('acc_last_name', $this->request->getPost('last_name'));
		$this->session->set('acc_birth_date', $this->request->getPost('birth_date'));
		$this->session->set('acc_gender', (bool) $this->request->getPost('gender'));

		return redirect()->to(base_url('u'));
	}
}
