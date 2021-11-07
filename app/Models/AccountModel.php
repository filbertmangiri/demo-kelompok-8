<?php

namespace App\Models;

use CodeIgniter\Model;

class AccountModel extends Model
{
	protected $table      = 'accounts';
	protected $primaryKey = 'id';

	protected $useAutoIncrement = true;

	protected $returnType     = 'array';

	protected $allowedFields = [
		'email',
		'username',
		'password',
		'first_name',
		'last_name',
		'birth_date',
		'gender',
		'is_admin',
		'deleted_at'
	];

	protected $useTimestamps = true;
	protected $createdField  = 'created_at';
	protected $updatedField  = 'updated_at';

	protected $useSoftDeletes = true;
	protected $deletedField  = 'deleted_at';

	protected $validationRules    = [];
	protected $validationMessages = [];
	protected $skipValidation     = true;

	public function getAccount($post = [], $onlyDeleted = false): array
	{
		if (!$post) {
			if ($onlyDeleted) {
				return $this->onlyDeleted()->findAll();
			}

			return $this->findAll();
		}

		$account = $this
			->where('email', $post['email_username'])
			->orWhere('username', $post['email_username'])
			->first();

		if (!$account || !password_verify($post['password'], $account['password'])) {
			return [];
		}

		return $account;
	}

	public function insertAccount($post): int
	{
		$insertedID = -1;

		try {
			$this->insert([
				'email' => $post['email'],
				'username' => $post['username'],
				'password' => password_hash($post['password'], PASSWORD_DEFAULT),
				'first_name' => $post['first_name'],
				'last_name' => $post['last_name'],
				'birth_date' => $post['birth_date'],
				'gender' => $post['gender'],
				'is_admin' => false
			]);

			$insertedID = $this->getInsertID();
		} catch (\Exception $e) {
			$insertedID = -1;
		}

		return $insertedID;
	}

	public function deleteAccount($id): string
	{
		$error_msg = '';

		try {
			$this->delete($id);
		} catch (\Exception $e) {
			$error_msg = $e->getMessage();
		}

		return $error_msg;
	}

	public function restoreAccount($id): string
	{
		$error_msg = '';

		try {
			$this->update($id, ['deleted_at' => null]);
		} catch (\Exception $e) {
			$error_msg = $e->getMessage();
		}

		return $error_msg;
	}
}
