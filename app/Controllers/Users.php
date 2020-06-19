<?php

namespace App\Controllers;

use App\Models\UserModel;


class Users extends BaseController
{
	public function index()
	{
		$data = [];
		helper(['form']);

		if ($this->request->getMethod() == 'post') {
			$rules = [
				'login' => 'required|min_length[4]|max_length[50]',
				'senha' => 'required|min_length[8]|max_length[255]|validateUser[login,senha]',
			];

			$errors = [
				'senha' => [
					'validateUser' => 'Login ou senha incorreto.'
				]
			];

			if (!$this->validate($rules, $errors)) {
				$data['validation'] = $this->validator;
			} else {

				$model = new UserModel();
				$user = $model->where('loginUsuario', $this->request->getVar('login'))
					->first();

				$this->setUserSession($user);
				return redirect()->to('dashboard');
			}
		}

		echo view('templates/header', $data);
		echo view('login');
		echo view('templates/footer');
	}

	public function register()
	{
		$data = [];
		helper(['form']);

		if ($this->request->getMethod() == 'post') {

			$rules = [
				'login' => 'required|min_length[3]|max_length[20]',
				'senha' => 'required|min_length[8]|max_length[255]',
				'senha_confirm' => 'matches[senha]',
			];

			if (!$this->validate($rules)) {
				$data['validation'] = $this->validator;
			} else {
				$model = new UserModel();

				$newData = [
					'loginUsuario' => $this->request->getVar('login'),
					'senhaUsuario' => $this->request->getVar('senha'),
				];
				$model->save($newData);
				$session = session();
				$session->setFlashdata('success', 'Successful Registration');
				return redirect()->to('/');
			}
		}

		echo view('templates/header', $data);
		echo view('register');
		echo view('templates/footer');
	}

	public function profile()
	{

		$data = [];
		helper(['form']);
		$model = new UserModel();

		if ($this->request->getMethod() == 'post') {
			//let's do the validation here
			$rules = [
				'login' => 'required|min_length[3]|max_length[20]',
			];

			if ($this->request->getPost('senha') != '') {
				$rules['senha'] = 'required|min_length[8]|max_length[255]';
				$rules['senha_confirm'] = 'matches[senha]';
			}


			if (!$this->validate($rules)) {
				$data['validation'] = $this->validator;
			} else {

				$newData = [
					'id' => session()->get('id'),
					'login' => $this->request->getPost('login'),
				];
				if ($this->request->getPost('senha') != '') {
					$newData['senha'] = $this->request->getPost('senha');
				}
				$model->save($newData);

				session()->setFlashdata('success', 'Successfuly Updated');
				return redirect()->to('/profile');
			}
		}

		$data['user'] = $model->where('id', session()->get('id'))->first();
		echo view('templates/header', $data);
		echo view('profile');
		echo view('templates/footer');
	}

	private function setUserSession($user)
	{
		$data = [
			'id' => $user['idUsuario'],
			'login' => $user['loginUsuario'],
			'isLoggedIn' => true,
		];

		session()->set($data);
		return true;
	}
	public function logout()
	{
		session()->destroy();
		return redirect()->to('/');
	}
}
