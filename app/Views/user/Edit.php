<?php
namespace App\Controllers\User;
use CodeIgniter\Controller;
use App\Models\UserModel;
use Config\Services;

class Edit extends Controller {

	/**
	 * Instance of the main Request object.
	 *
	 * @var CLIRequest|IncomingRequest
	 */

	protected $request;
	protected $helpers = ['form'];
	
	public function index($id){
		$userModel = new UserModel();
		$data['user'] = $userModel->readUser($id);
		echo view('user/edit',$data);
	}

	public function save($id){
		$userModel = new UserModel();

		$validation = $this->validate([
			'name' => 'required',
			'email' => 'required|valid_email',
			'biography' => 'required|min_length[10]',
		]);

		if(!$validation){

			return redirect()->to('/usuario/'.$id)->withInput();
			
		} else {

			$data = [
				'name' => $this->request->getVar('name'),
				'email' => $this->request->getVar('email'),
				'biography' => $this->request->getVar('biography'),
			];
	
			$userModel->updateUser($id, $data);

			$session = Services::session();
			$session->setFlashdata('success', 'Los datos se actualizaron correctamente');
	
			return redirect()->to('/usuarios');
		}

	}
}