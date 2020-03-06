<?php

namespace App\src\controller;

use App\config\Parameter;

class UserController extends Controller
{
	/**
	 * login verify if $post data correspond to row in db
	 * 
	 * @param  Parameter $post
	 * @return void
	 */
	public function login(Parameter $post)
	{
		if ($post->get('submit')) {
			$result = $this->userDAO->login($post);
			if ($result && $result['isPasswordValid']) {
				$this->session->set('login_ok', 'Content de vous revoir');
				$this->session->set('id', $result['result']['id']);
				$this->session->set('name', $result['result']['name']);
				$this->session->set('login', $post->get('login'));
				header('Location: index.php?route=listChildren');
				exit;
			} else {
				$this->session->set('error_login', 'Le login ou le mot de passe sont incorrects');
				return $this->view->render('login', [
					'post' => $post
				]);
			}
		}
		return $this->view->render('login');
	}

	public function logout()
	{
		$this->session->stop();
		$this->session->start();
		header('Location: index.php');
		exit;
	}
}
