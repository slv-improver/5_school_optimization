<?php

namespace App\src\DAO;

use App\config\Parameter;

class UserDAO extends DAO
{	
	/**
	 * login
	 *
	 * @param  Parameter $post
	 * @return array 
	 */
	public function login(Parameter $post)
	{
		$sql = 'SELECT id, name, password 
			FROM user WHERE login = ?';
		$data = $this->createQuery($sql, [$post->get('login')]);
		$result = $data->fetch();
		$isPasswordValid = password_verify($post->get('password'), $result['password']);
		return [
			'result' => $result,
			'isPasswordValid' => $isPasswordValid
		];
	}
}
