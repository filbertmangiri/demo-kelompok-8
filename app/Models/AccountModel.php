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
		'profile_picture',
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

	public function getAccount($post = []): array
	{
		if (!$post) {
			return $this->withDeleted()->findAll();
		}

		if (!isset($post['email_username'])) {
			return $this->where($post)->first();
		}

		$account = $this
			->groupStart()
			->where('email', $post['email_username'])
			->orWhere('username', $post['email_username'])
			->groupEnd()
			->first();

		// $db = \Config\Database::connect();
		// $email_username = $db->escapeString($post['email_username']);
		// $account = $db
		// 	->query("SELECT * FROM `accounts` WHERE (`email` = '$email_username' OR `username` = '$email_username') AND `deleted_at` IS NULL LIMIT 1")
		// 	->getFirstRow('array');

		// $account = db_connect() // => \Config\Database::connect()
		// 	->table('accounts')
		// 	->select('*')
		// 	->groupStart()
		// 	->where('email', $post['email_username'])
		// 	->orWhere('username', $post['email_username'])
		// 	->groupEnd()
		// 	->where('deleted_at', null)
		// 	->get(1)
		// 	->getFirstRow('array');

		if (!$account || !password_verify($post['password'], $account['password'])) {
			return [];
		}

		return $account;
	}

	public function insertAccount($post, $file): int
	{
		$insertedID = -1;

		try {
			$insertedID = $this->insert([
				'email' => $post['email'],
				'username' => $post['username'],
				'password' => password_hash($post['password'], PASSWORD_DEFAULT),
				'first_name' => $post['first_name'],
				'last_name' => $post['last_name'],
				'birth_date' => $post['birth_date'],
				'gender' => (bool) $post['gender'],
			]);

			if ($file['profile_picture']->getError() === UPLOAD_ERR_OK) {
				$fileName = 'profile-' . $insertedID . '.' . $file['profile_picture']->guessExtension();

				$file['profile_picture']->move('img/profile-pictures', $fileName, true);
			} else {
				$fileName = 'default-' . (!(bool) $post['gender'] ? 'male' : 'female') . '.png';
			}

			$this->update($insertedID, ['profile_picture' => $fileName]);
		} catch (\Exception $e) {
			$insertedID = -1;
		}

		return $insertedID;
	}

	public function updateAccount($id, $post, $file): bool
	{
		try {
			settype($post['gender'], 'boolean');

			if ($file['profile_picture']->getError() === 0) {
				$fileName = 'profile-' . $id . '.' . $file['profile_picture']->guessExtension();

				$file['profile_picture']->move('img/profile-pictures', $fileName, true);
			} else {
				$fileName = $post['old_profile_picture'];
			}

			$post['profile_picture'] = $fileName;

			$this->update($id, $post);
		} catch (\Exception $e) {
			return false;
		}

		return true;
	}

	public function deleteAccount($id, $purge = false): string
	{
		$error_msg = '';

		try {
			$account = db_connect()
				->table('accounts')
				->select('profile_picture')
				->where('id', $id)
				->get(1)
				->getFirstRow('array');

			if ($purge && !str_starts_with($account['profile_picture'], 'default')) {
				unlink('img/profile-pictures/' . $account['profile_picture']);
			}

			$this->delete($id, $purge);
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
