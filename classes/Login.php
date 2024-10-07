<?php
require_once '../config.php';
class Login extends DBConnection
{
	private $settings;
	public function __construct()
	{
		global $_settings;
		$this->settings = $_settings;

		parent::__construct();
		ini_set('display_error', 1);
	}
	public function __destruct()
	{
		parent::__destruct();
	}
	public function index()
	{
		echo "<h1>Access Denied</h1> <a href='" . base_url . "'>Go Back.</a>";
	}

	public function login_admin()
	{
		extract($_POST);

		$stmt = $this->conn->prepare("SELECT * from users where username = ? and password = ?");
		$password = md5($password);
		$stmt->bind_param('ss', $username, $password);
		$stmt->execute();
		$result = $stmt->get_result();

		if ($result->num_rows > 0) {
			$user = $result->fetch_assoc();
			if ($user['type'] == 1) { // Admin type
				foreach ($user as $k => $v) {
					if ($k != 'password') {
						$this->settings->set_userdata($k, $v);
					}
				}
				$this->settings->set_userdata('login_type', 1);
				return json_encode(array('status' => 'success'));
			} else {
				return json_encode(array('status' => 'incorrect_role'));
			}
		} else {
			return json_encode(array('status' => 'incorrect'));
		}
	}

	public function login_superadmin()
	{
		extract($_POST);

		$stmt = $this->conn->prepare("SELECT * from users where username = ? and password = ?");
		$password = md5($password);
		$stmt->bind_param('ss', $username, $password);
		$stmt->execute();
		$result = $stmt->get_result();

		if ($result->num_rows > 0) {
			$user = $result->fetch_assoc();
			if ($user['type'] == 2) { // Superadmin type
				foreach ($user as $k => $v) {
					if ($k != 'password') {
						$this->settings->set_userdata($k, $v);
					}
				}
				$this->settings->set_userdata('login_type', 2);
				return json_encode(array('status' => 'success'));
			} else {
				return json_encode(array('status' => 'incorrect_role'));
			}
		} else {
			return json_encode(array('status' => 'incorrect'));
		}
	}

	public function login_staff()
	{
		extract($_POST);

		$stmt = $this->conn->prepare("SELECT * from users where username = ? and password = ?");
		$password = md5($password);
		$stmt->bind_param('ss', $username, $password);
		$stmt->execute();
		$result = $stmt->get_result();

		if ($result->num_rows > 0) {
			$user = $result->fetch_assoc();
			if ($user['type'] == 3) { // Staff type
				foreach ($user as $k => $v) {
					if ($k != 'password') {
						$this->settings->set_userdata($k, $v); //staff id
					}
				}
				$this->settings->set_userdata('login_type', 3);
				return json_encode(array('status' => 'success'));
			} else {
				return json_encode(array('status' => 'incorrect_role'));
			}
		} else {
			return json_encode(array('status' => 'incorrect'));
		}
	}
	function login_user()
	{
		extract($_POST);
		$stmt = $this->conn->prepare("SELECT * from clients where email = ? and `password` = ? and delete_flag = 0 ");
		$password = md5($password);
		$stmt->bind_param('ss', $email, $password);
		$stmt->execute();
		$result = $stmt->get_result();
		if ($result->num_rows > 0) {
			$res = $result->fetch_array();
			if ($res['status'] == 1) {
				foreach ($res as $k => $v) {
					$this->settings->set_userdata($k, $v);
				}
				$this->settings->set_userdata('login_type', 2);
				$resp['status'] = 'success';
			} else {
				$resp['status'] = 'failed';
				$resp['msg'] = 'Your Account has been blocked.';
			}
		} else {
			$resp['status'] = 'failed';
			$resp['msg'] = 'Incorrect Email or Password';
		}
		if ($this->conn->error) {
			$resp['status'] = 'failed';
			$resp['_error'] = $this->conn->error;
		}
		return json_encode($resp);
	}
	public function logout_admin()
	{
		if ($this->settings->sess_des()) {
			redirect('admin/login.php');
		}
	}
	public function logout_superadmin()
	{
		if ($this->settings->sess_des()) {
			redirect('superadmin/login.php');
		}
	}
	public function logout_staff()
	{
		if ($this->settings->sess_des()) {
			redirect('staff/login.php');
		}
	}
}
$action = !isset($_GET['f']) ? 'none' : strtolower($_GET['f']);
$auth = new Login();
switch ($action) {
	case 'login_admin':
		echo $auth->login_admin();
		break;
	case 'login_superadmin':
		echo $auth->login_superadmin();
		break;
	case 'login_staff':
		echo $auth->login_staff();
		break;
	case 'login_user':
		echo $auth->login_user();
		break;
	case 'logout_admin':
		echo $auth->logout_admin();
		break;
	case 'logout_superadmin':
		echo $auth->logout_superadmin();
		break;
	case 'logout_staff':
		echo $auth->logout_staff();
		break;
	default:
		echo $auth->index();
		break;
}
