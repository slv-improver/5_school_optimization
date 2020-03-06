<?php

namespace App\src\controller;

use App\config\Parameter;

class ChildController extends Controller
{
	public function listChildren()
	{
		if ($this->checkLoggedIn()) {
			$children = $this->childDAO->listChildren();
			return $this->view->render('home', [
				'children' => $children
				]);
		}
	}

	public function addChild()
	{
		return $this->view->render('register');
	}
}
