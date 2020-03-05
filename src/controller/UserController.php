<?php

namespace App\src\controller;

class UserController extends Controller
{	
	public function login()
	{
		return $this->view->render('login');
	}
}
