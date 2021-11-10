<?php

namespace App\Controllers\Account;

use App\Controllers\BaseController;
use App\Models\AccountModel;

class Register extends BaseController
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
			'title' => 'Daftar',
			'validation' => \Config\Services::validation()
		];

		return view('account/register', $data);
	}

	public function insert()
	{
		if (!$this->validate([
			'email' => 'required|valid_email|is_unique[accounts.email]',
			'username' => 'required|alpha_numeric|min_length[5]|max_length[50]|is_unique[accounts.username]',
			'password' => 'required|min_length[5]',
			'password_confirm' => 'required|matches[password]',
			'first_name' => 'required|alpha_space|min_length[2]',
			'last_name' => 'alpha_space',
			'birth_date' => 'required|valid_date|less_than_today',
			'gender' => 'required',
			'profile_picture' => 'max_size[profile_picture,10240]|is_image[profile_picture]|mime_in[profile_picture,image/png,image/jpg,image/jpeg,image/gif]|ext_in[profile_picture,png,jpg,jpeg,gif]'
		])) {
			return redirect()->to(base_url('account/register'))->withInput();
		}

		$insertedID = $this->accountModel->insertAccount($this->request->getPost(), $this->request->getFiles());

		if ($insertedID <= 0) {
			return redirect()->to(base_url('account/register'))->withInput()->with('register_error_msg', 'Gagal mendaftar');
		}

		$this->session->set('acc_id', $insertedID);

		$this->session->set('acc_email', $this->request->getPost('email'));
		$this->session->set('acc_username', $this->request->getPost('username'));
		$this->session->set('acc_first_name', $this->request->getPost('first_name'));
		$this->session->set('acc_last_name', $this->request->getPost('last_name'));
		$this->session->set('acc_birth_date', $this->request->getPost('birth_date'));
		$this->session->set('acc_gender', (bool) $this->request->getPost('gender'));

		$this->session->set('is_logged_in', true);

		return redirect()->to(base_url());
	}
}
