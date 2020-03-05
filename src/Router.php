<?php

namespace App\src;

use App\src\controller\UserController;
use App\src\controller\ErrorController;
use App\config\Request;
use Exception;

class Router
{
	
	private $userController;
	private $errorController;
	private $request;

	public function __construct()
	{
		$this->userController = new UserController();
		$this->errorController = new ErrorController();
		$this->request = new Request(); /* for $_GET, $_POST and $_SESSION */
	}

	public function run()
	{
		$route = $this->request->getGet()->get('route');
		try {
			if (isset($route)) {
				switch ($route) {
					case 'login':
						$this->userController->login();
						break;

					default:
					// if route value is not defined redirect to error_404.php
						$this->errorController->errorNotFound();
						break;
				}
			// by default
			} else {
				$this->userController->login();
			}
		} catch (Exception $e) {
			// redirect to error_500.php
			$this->errorController->errorServer();
		}
	}
}
