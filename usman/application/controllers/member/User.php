<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

	public function __construct(){
    parent::__construct();
    is_logged_in();
		$this->load->model('User_model', 'mUser');
		$this->load->library('form_validation');
  }

	public function index()
	{
		$data['title'] = "Master Users";
		$data['user'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row_array();
		$data['role'] = $this->mUser->get_user_role();
		$this->load->view('member/user', $data);
	}

	public function ajax_list()
	{
		$list = $this->mUser->get_datatables();
		$data = array();
		$start = $_POST['start'];
		$no =1;
		foreach ($list as $user) {
			$image_properties = array(
	        'src'   => base_url('assets/img/'.$user->image),
	        'alt'   => 'default.jpg',
	        'class' => 'post_images',
	        'width' => '40',
	        'height'=> '40'
			);

			$row = array();
			$row[] = $no++;
			$row[] = $user->name;
			$row[] = $user->email;
			$row[] = img($image_properties);

			//add html for action
			$row[] = '<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_user(' . "'" . $user->id . "'" . ')"><i class="glyphicon glyphicon-pencil"></i> Edit</a>
				  <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_user(' . "'" . $user->id . "'" . ')"><i class="glyphicon glyphicon-trash"></i> Delete</a>';

			$data[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->mUser->count_all(),
			"recordsFiltered" => $this->mUser->count_filtered(),
			"data" => $data,
		);
		//output to json format
		echo json_encode($output);
	}

	private function _validate()
	{
		$data = array();
		$file = $this->_aksi_upload();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = true;
		$data['error'] = '';

		if ($this->input->post('name') == '') {
			$data['inputerror'][] = 'name';
			$data['error_string'][] = 'Name harus di isi';
			$data['status'] = false;
		}

		if ($this->input->post('email') == '') {
			$data['inputerror'][] = 'email';
			$data['error_string'][] = 'email harus diisi';
			$data['status'] = false;
		}

		if ($this->input->post('password') == '') {
			$data['inputerror'][] = 'password';
			$data['error_string'][] = 'password harus diisi';
			$data['status'] = false;
		}

		if ($this->input->post('password') != $this->input->post('password2')) {
			$data['inputerror'][] = 'password2';
			$data['error_string'][] = 'password tidak sama';
			$data['status'] = false;
		}

		if ($this->input->post('role') == '') {
			$data['inputerror'][] = 'role';
			$data['error_string'][] = 'Role harus dipilih';
			$data['status'] = false;
		}

		if (isset($file['error'])) {
			$data['inputerror'][] = 'userfile';
			$data['error_string'][] = substr($file['error'],3,-5);
			$data['status'] = false;
		}

		if ($data['status'] === false) {
			echo json_encode($data);
			exit();
		}
	}

	private function _aksi_upload()
	{
			$config['upload_path']          = './assets/img/';
			$config['allowed_types']        = 'gif|jpg|png';
			$config['max_size']             = 100;
			$config['max_width']            = 1024;
			$config['max_height']           = 768;

			$this->load->library('upload', $config);

			if (!$this->upload->do_upload('userfile')) {
					$error = array('error' => $this->upload->display_errors());
					return $error;
			} else {
					$result = array('upload_data' => $this->upload->data());
					return $result;
			}
	}

	function ajax_add()
	{
		$this->_validate();
		$file = $this->_aksi_upload();
		$img = $file['upload_data']['file_name'];
		$data = array(
			'name' => $this->input->post('name'),
			'email' => $this->input->post('email'),
			'password' => password_hash($this->input->post('password'),PASSWORD_DEFAULT),
			'image' => $img,
			'role_id' => $this->input->post('role'),
			'is_active' =>1,
			'date_created' => time()
			);
			$insert = $this->mUser->save($data);
			echo json_encode(array("status" => true));
		}

	public function ajax_delete($id)
	{
		$this->mUser->delete_by_id($id);
		echo json_encode(array("status" => true));
	}

	public function ajax_update()
	{
		$this->_validate();
		$file = $this->_aksi_upload();
		$img = $file['upload_data']['file_name'];
		$data = array(
			'name' => $this->input->post('name'),
			'email' => $this->input->post('email'),
			'password' => password_hash($this->input->post('password'),PASSWORD_DEFAULT),
			'image' => $img,
			'role_id' => $this->input->post('role'),
			'is_active' =>1,
			'date_created' => time()
			);
		$test = $this->mUser->update(array('id' => $this->input->post('id')), $data);
		echo json_encode(array("status" => true));
	}

	public function ajax_edit($id)
	{
		$data = $this->mUser->get_by_id($id);
		echo json_encode($data);
	}

}
