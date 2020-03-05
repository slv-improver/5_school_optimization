<?php

namespace App\src\controller;

use App\config\Request;
use App\src\model\View;

/**
 * Controller handles incoming browser requests,
 * retrieves necessary model data
 * and requires appropriate views
 */
abstract class Controller
{
	protected $request;
	protected $get;
	protected $post;
	protected $session;
	protected $view;

	public function __construct()
	{
		$this->request = new Request(); /* for $_GET, $_POST and $_SESSION */
		$this->get = $this->request->getGet();
		$this->post = $this->request->getPost();
		$this->session = $this->request->getSession();
		$this->view = new View();
	}
}
