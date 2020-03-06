<?php

namespace App\src;

use App\src\controller\{
	ChildController,
	UserController,
	ErrorController
};
use App\config\Request;
use Exception;

class Router
{
	
	private $userController;
	private $errorController;
	private $request;

	public function __construct()
	{
		$this->childController = new ChildController();
		$this->userController = new UserController();
		$this->errorController = new ErrorController();
		$this->request = new Request(); /* for $_GET, $_POST and $_SESSION */
	}

	public function run()
	{
		$route = $this->request->getGet()->get('route');
		$post = $this->request->getPost();
		try {
			if (isset($route)) {
				switch ($route) {
					case 'login':
						$this->userController->login($post);
						break;
					case 'logout':
						$this->userController->logout();
						break;
					case 'listChildren':
						$this->childController->listChildren();
						break;

					default:
					// if route value is not defined redirect to error_404.php
						$this->errorController->errorNotFound();
						break;
				}
			// by default
			} else {
				$this->userController->login($post);
			}
		} catch (Exception $e) {
			// redirect to error_500.php
			$this->errorController->errorServer();
		}
	}
}
