<?php
require_once('../config.php');
class Users extends DBConnection
{
	private $settings;
	public function __construct()
	{
		global $_settings;
		$this->settings = $_settings;
		parent::__construct();
	}
	public function __destruct()
	{
		parent::__destruct();
	}
	public function save_users()
	{
		extract($_POST);
		$data = '';
		foreach ($_POST as $k => $v) {
			if (!in_array($k, array('id', 'password'))) {
				if (!empty($data)) $data .= " , ";
				$data .= " {$k} = '{$v}' ";
			}
		}
		if (!empty($password) && !empty($id)) {
			$password = md5($password);
			if (!empty($data)) $data .= " , ";
			$data .= " `password` = '{$password}' ";
		}
		if (empty($id)) {
			$qry = $this->conn->query("INSERT INTO users set {$data}");
			if ($qry) {
				$id = $this->conn->insert_id;
				$this->settings->set_flashdata('success', 'User Details successfully saved.');
				foreach ($_POST as $k => $v) {
					if ($k != 'id') {
						if (!empty($data)) $data .= " , ";
						$this->settings->set_userdata($k, $v);
					}
				}
				if (!empty($_FILES['img']['tmp_name'])) {
					if (!is_dir(base_app . "uploads/avatars"))
						mkdir(base_app . "uploads/avatars");
					$ext = pathinfo($_FILES['img']['name'], PATHINFO_EXTENSION);
					$fname = "uploads/avatars/$id.$ext";
					$accept = array('image/jpeg', 'image/png');
					if (!in_array($_FILES['img']['type'], $accept)) {
						$err = "Image file type is invalid";
					}
					if ($_FILES['img']['type'] == 'image/jpeg')
						$uploadfile = imagecreatefromjpeg($_FILES['img']['tmp_name']);
					elseif ($_FILES['img']['type'] == 'image/png')
						$uploadfile = imagecreatefrompng($_FILES['img']['tmp_name']);
					if (!$uploadfile) {
						$err = "Image is invalid";
					}
					$temp = imagescale($uploadfile, 200, 200);
					if (is_file(base_app . $fname))
						unlink(base_app . $fname);
					if ($_FILES['img']['type'] == 'image/jpeg')
						$upload = imagejpeg($temp, base_app . $fname);
					elseif ($_FILES['img']['type'] == 'image/png')
						$upload = imagepng($temp, base_app . $fname);
					else
						$upload = false;
					if ($upload) {
						$this->conn->query("UPDATE `users` set `avatar` = CONCAT('{$fname}', '?v=',unix_timestamp(CURRENT_TIMESTAMP)) where id = '{$id}'");
						$this->settings->set_userdata('avatar', $fname . "?v=" . time());
					}

					imagedestroy($temp);
				}
				return 1;
			} else {
				return 2;
			}
		} else {
			$qry = $this->conn->query("UPDATE users set $data where id = {$id}");
			if ($qry) {
				$this->settings->set_flashdata('success', 'User Details successfully updated.');
				foreach ($_POST as $k => $v) {
					if ($k != 'id') {
						if (!empty($data)) $data .= " , ";
						$this->settings->set_userdata($k, $v);
					}
				}
				if (!empty($_FILES['img']['tmp_name'])) {
					if (!is_dir(base_app . "uploads/avatars"))
						mkdir(base_app . "uploads/avatars");
					$ext = pathinfo($_FILES['img']['name'], PATHINFO_EXTENSION);
					$fname = "uploads/avatars/$id.$ext";
					$accept = array('image/jpeg', 'image/png');
					if (!in_array($_FILES['img']['type'], $accept)) {
						$err = "Image file type is invalid";
					}
					if ($_FILES['img']['type'] == 'image/jpeg')
						$uploadfile = imagecreatefromjpeg($_FILES['img']['tmp_name']);
					elseif ($_FILES['img']['type'] == 'image/png')
						$uploadfile = imagecreatefrompng($_FILES['img']['tmp_name']);
					if (!$uploadfile) {
						$err = "Image is invalid";
					}
					$temp = imagescale($uploadfile, 200, 200);
					if (is_file(base_app . $fname))
						unlink(base_app . $fname);
					if ($_FILES['img']['type'] == 'image/jpeg')
						$upload = imagejpeg($temp, base_app . $fname);
					elseif ($_FILES['img']['type'] == 'image/png')
						$upload = imagepng($temp, base_app . $fname);
					else
						$upload = false;
					if ($upload) {
						$this->conn->query("UPDATE `users` set `avatar` = CONCAT('{$fname}', '?v=',unix_timestamp(CURRENT_TIMESTAMP)) where id = '{$id}'");
						$this->settings->set_userdata('avatar', $fname . "?v=" . time());
					}

					imagedestroy($temp);
				}

				return 1;
			} else {
				return "UPDATE users set $data where id = {$id}";
			}
		}
	}
	public function save_farmer()
	{
		extract($_POST);
		$data = '';
		$username_exists = false;

		// Check if the username already exists
		if (!empty($username)) {
			$check_query = $this->conn->query("SELECT id FROM users WHERE username = '{$username}'" . (!empty($id) ? " AND id != '{$id}'" : ""));
			if ($check_query->num_rows > 0) {
				return "Username already exists";
			}
		}

		foreach ($_POST as $k => $v) {
			// Handle checkbox arrays (e.g. additional_requirements, required_documents)
			if (is_array($v)) {
				$v = json_encode($v); // Convert the array to JSON format before saving
			}

			if (!in_array($k, array('id', 'password'))) {
				if (!empty($data)) $data .= " , ";
				$data .= " {$k} = '{$v}' ";
			}
		}

		if (!empty($password) && !empty($id)) {
			$password = md5($password);
			if (!empty($data)) $data .= " , ";
			$data .= " `password` = '{$password}' ";
		}

		if (empty($id)) {
			$qry = $this->conn->query("INSERT INTO users SET {$data}");
			if ($qry) {
				$id = $this->conn->insert_id;
				$this->settings->set_flashdata('success', 'User Details successfully saved.');
				foreach ($_POST as $k => $v) {
					if ($k != 'id') {
						if (!empty($data)) $data .= " , ";
						$this->settings->set_userdata($k, $v);
					}
				}
				// Handle file upload and avatar update
				$this->handle_file_upload($id);
				return 1;
			} else {
				return 2;
			}
		} else {
			$qry = $this->conn->query("UPDATE users SET $data WHERE id = {$id}");
			if ($qry) {
				$this->settings->set_flashdata('success', 'User Details successfully updated.');
				foreach ($_POST as $k => $v) {
					if ($k != 'id') {
						if (!empty($data)) $data .= " , ";
						$this->settings->set_userdata($k, $v);
					}
				}
				// Handle file upload and avatar update
				$this->handle_file_upload($id);
				return 1;
			} else {
				return "UPDATE users SET $data WHERE id = {$id}";
			}
		}
	}


	private function handle_file_upload($id)
	{
		if (!empty($_FILES['img']['tmp_name'])) {
			if (!is_dir(base_app . "uploads/avatars"))
				mkdir(base_app . "uploads/avatars");
			$ext = pathinfo($_FILES['img']['name'], PATHINFO_EXTENSION);
			$fname = "uploads/avatars/$id.$ext";
			$accept = array('image/jpeg', 'image/png');
			if (!in_array($_FILES['img']['type'], $accept)) {
				$err = "Image file type is invalid";
			}
			if ($_FILES['img']['type'] == 'image/jpeg')
				$uploadfile = imagecreatefromjpeg($_FILES['img']['tmp_name']);
			elseif ($_FILES['img']['type'] == 'image/png')
				$uploadfile = imagecreatefrompng($_FILES['img']['tmp_name']);
			if (!$uploadfile) {
				$err = "Image is invalid";
			}
			$temp = imagescale($uploadfile, 200, 200);
			if (is_file(base_app . $fname))
				unlink(base_app . $fname);
			if ($_FILES['img']['type'] == 'image/jpeg')
				$upload = imagejpeg($temp, base_app . $fname);
			elseif ($_FILES['img']['type'] == 'image/png')
				$upload = imagepng($temp, base_app . $fname);
			else
				$upload = false;
			if ($upload) {
				$this->conn->query("UPDATE `users` SET `avatar` = CONCAT('{$fname}', '?v=', UNIX_TIMESTAMP(CURRENT_TIMESTAMP)) WHERE id = '{$id}'");
				$this->settings->set_userdata('avatar', $fname . "?v=" . time());
			}
			imagedestroy($temp);
		}
	}

	public function delete_users()
	{
		extract($_POST);
		$qry = $this->conn->query("DELETE FROM users where id = $id");
		if ($qry) {
			$this->settings->set_flashdata('success', 'User Details successfully deleted.');
			return 1;
		} else {
			return false;
		}
	}
	public function save_fusers()
	{
		extract($_POST);
		$data = "";
		foreach ($_POST as $k => $v) {
			if (!in_array($k, array('id', 'password'))) {
				if (!empty($data)) $data .= ", ";
				$data .= " `{$k}` = '{$v}' ";
			}
		}

		if (!empty($password))
			$data .= ", `password` = '" . md5($password) . "' ";

		if (isset($_FILES['img']) && $_FILES['img']['tmp_name'] != '') {
			$fname = 'uploads/' . strtotime(date('y-m-d H:i')) . '_' . $_FILES['img']['name'];
			$move = move_uploaded_file($_FILES['img']['tmp_name'], '../' . $fname);
			if ($move) {
				$data .= " , avatar = '{$fname}' ";
				if (isset($_SESSION['userdata']['avatar']) && is_file('../' . $_SESSION['userdata']['avatar']))
					unlink('../' . $_SESSION['userdata']['avatar']);
			}
		}
		$sql = "UPDATE faculty set {$data} where id = $id";
		$save = $this->conn->query($sql);

		if ($save) {
			$this->settings->set_flashdata('success', 'User Details successfully updated.');
			foreach ($_POST as $k => $v) {
				if (!in_array($k, array('id', 'password'))) {
					if (!empty($data)) $data .= " , ";
					$this->settings->set_userdata($k, $v);
				}
			}
			if (isset($fname) && isset($move))
				$this->settings->set_userdata('avatar', $fname);
			return 1;
		} else {
			$resp['error'] = $sql;
			return json_encode($resp);
		}
	}

	public function save_susers()
	{
		extract($_POST);
		$data = "";
		foreach ($_POST as $k => $v) {
			if (!in_array($k, array('id', 'password'))) {
				if (!empty($data)) $data .= ", ";
				$data .= " `{$k}` = '{$v}' ";
			}
		}

		if (!empty($password))
			$data .= ", `password` = '" . md5($password) . "' ";

		if (isset($_FILES['img']) && $_FILES['img']['tmp_name'] != '') {
			$fname = 'uploads/' . strtotime(date('y-m-d H:i')) . '_' . $_FILES['img']['name'];
			$move = move_uploaded_file($_FILES['img']['tmp_name'], '../' . $fname);
			if ($move) {
				$data .= " , avatar = '{$fname}' ";
				if (isset($_SESSION['userdata']['avatar']) && is_file('../' . $_SESSION['userdata']['avatar']))
					unlink('../' . $_SESSION['userdata']['avatar']);
			}
		}
		$sql = "UPDATE students set {$data} where id = $id";
		$save = $this->conn->query($sql);

		if ($save) {
			$this->settings->set_flashdata('success', 'User Details successfully updated.');
			foreach ($_POST as $k => $v) {
				if (!in_array($k, array('id', 'password'))) {
					if (!empty($data)) $data .= " , ";
					$this->settings->set_userdata($k, $v);
				}
			}
			if (isset($fname) && isset($move))
				$this->settings->set_userdata('avatar', $fname);
			return 1;
		} else {
			$resp['error'] = $sql;
			return json_encode($resp);
		}
	}
}

$users = new users();
$action = !isset($_GET['f']) ? 'none' : strtolower($_GET['f']);
switch ($action) {
	case 'save':
		echo $users->save_users();
		break;
	case 'save_farmer':
		echo $users->save_farmer();
		break;
	case 'fsave':
		echo $users->save_fusers();
		break;
	case 'ssave':
		echo $users->save_susers();
		break;
	case 'delete':
		echo $users->delete_users();
		break;
	default:
		// echo $sysset->index();
		break;
}
