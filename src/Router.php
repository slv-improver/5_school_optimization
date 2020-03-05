<?php

namespace App\src;

use App\src\controller\ErrorController;
use App\config\Request;
use Exception;

class Router
{
	
	private $errorController;
	private $request;

	public function __construct()
	{
		$this->request = new Request(); /* for $_GET, $_POST and $_SESSION */
		$this->errorController = new ErrorController();
	}

	public function run()
	{
		$route = $this->request->getGet()->get('route');
		try {
			if (isset($route)) {
				switch ($route) {

					default:
					// if route value is not defined redirect to error_404.php
						$this->errorController->errorNotFound();
						break;
				}
			// by default
			} else {
				
			}
		} catch (Exception $e) {
			// redirect to error_500.php
			$this->errorController->errorServer();
		}
	}
}
