<?php
namespace App\Controllers\User;
use CodeIgniter\Controller;
use App\Models\UserModel;
use Config\Services;

class Main extends Controller {

	public function index(){
		$userModel = new UserModel();
		$data['users'] = $userModel->readUsers();

		echo view('user/main',$data);
	}

	public function delete($id){
		$userModel = new UserModel();
		$userModel->deleteUser($id);

		$session = Services::session();
		$session->setFlashdata('success', 'Los datos se eliminaron correctamente');

		return redirect()->to('/usuarios');
	}

}