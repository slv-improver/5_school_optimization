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
		$get = $this->request->getGet();
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
					case 'addChild':
						$this->childController->addChild($post);
						break;
					case 'deleteChild':
						$this->childController->deleteChild($get->get('childId'));
						break;
					case 'childCard':
						$this->childController->childCard($get->get('childId'));
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
