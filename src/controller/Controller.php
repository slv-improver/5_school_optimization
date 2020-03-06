<?php

namespace App\src\controller;

use App\src\DAO\{
	ChildDAO,
	UserDAO
};
use App\config\Request;
use App\src\model\View;

/**
 * Controller handles incoming browser requests,
 * retrieves necessary model data
 * and requires appropriate views
 */
abstract class Controller
{
	protected $childDAO;
	protected $userDAO;
	protected $request;
	protected $get;
	protected $post;
	protected $session;
	protected $view;

	public function __construct()
	{
		$this->childDAO = new ChildDAO();
		$this->userDAO = new UserDAO();
		$this->request = new Request(); /* for $_GET, $_POST and $_SESSION */
		$this->get = $this->request->getGet();
		$this->post = $this->request->getPost();
		$this->session = $this->request->getSession();
		$this->view = new View();
	}

	/* for actions that require verification */
	protected function checkLoggedIn()
	{
		if (!$this->session->get('login')) {
			$this->session->set('need_login', 'Vous devez vous connecter pour accéder à cette page');
			header('Location: index.php?route=login');
		} else {
			return true;
		}
	}

}
