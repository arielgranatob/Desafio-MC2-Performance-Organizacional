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
				return redirect()->to('tarefa');
			}
		}

		echo view('login', $data);
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
				$session->setFlashdata('success', 'Cadastrado com sucesso!');
				return redirect()->to('/');
			}
		}

		echo view('register', $data);
	}

	public function profile()
	{
		$data = [];
		helper(['form']);
		$model = new UserModel();
		if ($this->request->getMethod() == 'post') {
			$rules = [
				'loginUsuario' => 'required|min_length[3]|max_length[20]',
			];

			if ($this->request->getPost('senhaUsuario') != '') {
				$rules['senhaUsuario'] = 'required|min_length[8]|max_length[255]';
				$rules['senha_confirm'] = 'matches[senha]';
			}

			if (!$this->validate($rules)) {
				$data['validation'] = $this->validator;
			} else {
				$newData = [
					'idUsuario' => session()->get('idUsuario'),
					'loginUsuario' => $this->request->getPost('loginUsuario'),
				];

				if ($this->request->getPost('senhaUsuario') != '') {
					$newData['senhaUsuario'] = $this->request->getPost('senhaUsuario');
				}

				$model->set($newData)->where('idUsuario', session()->get('idUsuario'))->update();
				session()->setFlashdata('success', 'Successfuly Updated');
				return redirect()->to('/profile');
			}
		}

		$data['user'] = $model->where('idUsuario', session()->get('idUsuario'))->first();
		echo view('profile', $data);
	}

	private function setUserSession($user)
	{
		$data = [
			'idUsuario' => $user['idUsuario'],
			'loginUsuario' => $user['loginUsuario'],
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
