<?php

namespace App\src\controller;

class ChildController extends Controller
{
	public function listChildren()
	{
		$children = $this->childDAO->listChildren();
	}
}
