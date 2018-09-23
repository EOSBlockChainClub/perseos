<?php
class PerseosController extends BaseClass
{
	/** @var DB */
	private $db;
	
	public function __construct()
	{
		$this->db = DB::getInstance();
	}
	
	public function info()
	{
		$countUsers = $this->db->_cell('SELECT count(*) from user');

		$response = [
			'totalUsers' => $countUsers
		];

		$this->returnJson($response);
	}

	public function setInfo()
	{
		$data = $this->getArray($_POST);
		$columns = $this->db->_array('show columns from user');
	}

	public function register()
	{
		$form = $this->getArray($_POST);

		if($this->db->_cell('select count(*) from user where email like "'.$form['email'].'"')) {
			$this->returnJson([
				'status' => 'error',
				'error'  => 'E-mail address is already taken'
			]);
			return;
		}

		$user = [
			'email' => $form['email'],
			'password' => password_hash($form['password'], PASSWORD_BCRYPT)
		];

		$id = $this->db->set('user', $user);
		$row = $this->db->_row("select * from user where id = '$id'");
		unset($row['password']);

		$this->returnJson([
			'status' => 'success',
			'user' => $row
		]);
	}

	public function signIn()
	{
		$form = $this->getArray($_POST);
		if($user = $this->db->_row('select * from user where email = "'.$form['email'].'"')) {
			if(password_verify($form['password'], $user['password'])) {
				unset($user['password']);

				$this->returnJson([
					'status' => 'success',
					'user'   => $user
				]);
			}
			else {
				$this->returnJson([
					'status' => 'error',
					'error'  => 'Invalid e-mail or password'
				]);
			}
		}
		else {
			$this->returnJson([
				'status' => 'error',
				'error'  => 'Invalid e-mail or password'
			]);
		}
	}

	private function returnJson($object) {
		$this->out = json_encode($object);
	}
}
