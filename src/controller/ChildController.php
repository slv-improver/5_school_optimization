<?php

namespace App\src\controller;

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
}
